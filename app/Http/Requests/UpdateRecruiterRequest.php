<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecruiterRequest extends FormRequest
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
			'location' => 'required|string',
			'profil_img_url' => 'required|string',
			'company_name' => 'required|string',
			'company_info' => 'required|string',
			'api_token' => 'required|string',
			'is_active' => 'required|boolean',
			'country_id' => 'required|integer',
			
        ];
    }
}