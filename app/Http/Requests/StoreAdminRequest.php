<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'firstname' => 'nullable|string',
			'lastname' => 'nullable|string',
			'email' => 'required|string|unqiue:admins',
			'password' => 'required|string',
			'phone_number' => 'nullable|string',
			'profil_img_url' => 'nullable|string',
			'country_id' => 'nullable|integer|exists:admins',
			'role_id' => 'nullable|integer|exists',

        ];
    }
}
