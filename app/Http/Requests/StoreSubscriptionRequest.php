<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
            'type' => 'nullable|string',
			'amount' => 'nullable|integer',
			'payment_mode' => 'required|string',
			'payment_status' => 'nullable|boolean',
			'expiration_date' => 'nullable|date',
			'subscriber_id' => 'nullable|integer',
			'subscription_pack_id' => 'required|integer|exists:subscription_packs,id',
        ];
    }
}
