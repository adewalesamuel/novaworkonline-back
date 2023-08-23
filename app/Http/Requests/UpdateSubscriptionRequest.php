<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
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
        return [
            'type' => 'required|string',
			'amount' => 'required|integer',
			'payment_mode' => 'required|string',
			'payment_status' => 'required|boolean',
			'expiration_date' => 'required|date',
			'subscriber_id' => 'required|integer',
			
        ];
    }
}