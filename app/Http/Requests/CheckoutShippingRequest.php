<?php

namespace Quincalla\Http\Requests;

use Quincalla\Http\Requests\Request;
use Quincalla\Entities\Checkout;

class CheckoutShippingRequest extends Request
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $accountType = $this->checkout->get('checkout.type');

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|not_in:0',
            'country' => 'required|not_in:0',
            'zipcode' => 'required',
            'phone' => 'required',
        ];

        if ($accountType === 'new-customer' || $accountType === 'guest') {
            $rules['account_email'] = 'required';
        }

        if ($accountType === 'new-customer') {
            $rules['password'] = 'required|confirmed';
        }
        return $rules;
    }
}
