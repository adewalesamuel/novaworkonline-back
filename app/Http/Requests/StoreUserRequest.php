<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'firstname' => 'required|string',
			'lastname' => 'required|string',
			'email' => 'required|string',
			'password' => 'required|string',
			'birth_date' => 'required|date',
			'gender' => 'required|string',
			'phone_number' => 'required|string',
			'city' => 'required|string',
			'profil_img_url' => 'required|string',
			'api_token' => 'required|string',
			'is_active' => 'required|boolean',
			'is_qualified' => 'required|boolean',
			'country_id' => 'required|integer',
			'jobtitle_id' => 'required|integer',
			
        ];
    }
}