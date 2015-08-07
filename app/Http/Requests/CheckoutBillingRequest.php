<?php

namespace Quincalla\Http\Requests;

use Quincalla\Http\Requests\Request;

class CheckoutBillingRequest extends Request
{
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
        $rules = [
            'name_on_card' => 'required',
            'card_number' => 'required',
            'expiration_date_month' => 'required',
            'expiration_date_year' => 'required',
            'ccv_code' => 'required',
            'card_type' => 'required|not_in:0',
        ];

        if ( ! $this->get('same_address')) {
            $rules + [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required|not_in:0',
                'country' => 'required|not_in:0',
                'zipcode' => 'required',
                'phone' => 'required',
            ];
        }

        return $rules;
    }
}
