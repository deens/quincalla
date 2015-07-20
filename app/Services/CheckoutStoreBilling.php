<?php

namespace Quincalla\Services;

use Quincalla\Entities\Checkout;
use Quincalla\Entities\Order;
use Quincalla\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as Validator;
use Quincalla\Entities\Cart;

class CheckoutStoreBilling
{
    protected $request;
    protected $checkout;
    protected $validator;
    protected $orders;
    protected $users;
    protected $paymentRules = [
        'name_on_card' => 'required',
        'card_number' => 'required',
        'expiration_date_month' => 'required',
        'expiration_date_year' => 'required',
        'ccv_code' => 'required',
        'card_type' => 'required|not_in:0',
    ];
    protected $billingRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required|not_in:0',
        'country' => 'required|not_in:0',
        'zipcode' => 'required',
        'phone' => 'required',
    ];

    public function __construct(
        Request $request,
        Checkout $checkout,
        Validator $validator,
        Order $orders,
        User $users,
        Cart $cart
    ) {
        $this->request = $request;
        $this->validator = $validator;
        $this->checkout = $checkout;
        $this->orders = $orders;
        $this->users = $users;
        $this->cart = $cart;
    }

    public function run($listener)
    {
        $this->listener = $listener;

        if (!$this->request->get('same_address')) {
            $this->paymentRules + $this->billingRules;
        }

        $validator = $this->validator->make($this->request->all(), $this->paymentRules);

        if ($validator->fails()) {
            $this->checkout->set('billing.same_address', $this->request->get('same_address'));

            $this->checkout->store();

            return $this->listener->redirectBackWithValidationErrors($validator);
        }

        $payment = [
            'name_on_card' => $this->request->get('name_on_card'),
            'card_number' => $this->request->get('card_number'),
            'card_type' => $this->request->get('card_type'),
            'expiration_date_month' => $this->request->get('expiration_date_month'),
            'expiration_date_year' => $this->request->get('expiration_date_year'),
            'ccv_code' => $this->request->get('ccv_code'),
        ];

        if ($this->request->get('same_address')) {
            $billingAddress = $this->checkout->get('shipping');
        } else {
            $billingAddress = [
                'first_name' => $this->request->get('first_name'),
                'last_name' => $this->request->get('last_name'),
                'address' => $this->request->get('address'),
                'address1' => $this->request->get('address1'),
                'city' => $this->request->get('city'),
                'state' => $this->request->get('state'),
                'country' => $this->request->get('country'),
                'phone' => $this->request->get('phone'),
                'zipcode' => $this->request->get('zipcode'),
            ];
        }

        $this->checkout->set(
            'account.name',
            $billingAddress['first_name'].' '.$billingAddress['last_name']
        );
        $this->checkout->set('payment', $payment);
        $this->checkout->set('billing', $billingAddress);
        $this->checkout->set(
            'billing.same_address',
            (bool) $this->request->get('same_address')
        );

        if ($this->checkout->get('checkout.type') !== 'customer') {
            if ($this->checkout->get('checkout.type') === 'new-customer') {
                $role = 'customer';
                $password = $this->checkout->get('account.password');
                $active = true;
            } else {
                $role = 'guest';
                $password = '';
                $active = false;
            }

            $user = $this->users->newInstance();
            $user->role = $role;
            $user->name = $this->checkout->get('account.name');
            $user->email = $this->checkout->get('account.email');
            $user->password = $password;
            $user->active = $active;
            $user->save();
        }

        // Create order
        $order = $this->orders->newInstance();
        $order->customer_email = $this->checkout->get('account.email');
        $order->customer_name = $this->checkout->get('account.name');
        $order->total_amount = $this->cart->total();
        $order->status = 'new';
        $order->card_name = $this->checkout->get('payment.name_on_card');
        $order->card_type = $this->checkout->get('payment.card_type');
        $order->card_number = $this->cardMasking($this->checkout->get('payment.card_number'));
        $order->shipping_address = json_encode($this->checkout->get('shipping'));
        $order->billing_address = json_encode($this->checkout->get('billing'));
        $order->save();

        // Create order products
        $cartContent = $this->cart->content();

        foreach ($cartContent as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'product_name' => $item->name,
                'attributes' => json_encode($item->options),
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        $this->cart->destroy();

        $this->checkout->store();

        return $this->listener->redirectToConfirmation();
    }

    /**
     * Mask credit card number.
     *
     * @param string $number
     *
     * @return string
     */
    private function cardMasking($number)
    {
        return str_repeat('*', strlen($number) - 4).substr($number, -4);
    }
}
