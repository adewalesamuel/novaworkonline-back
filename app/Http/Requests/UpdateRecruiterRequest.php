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
            'firstname' => 'nullable|string',
			'lastname' => 'nullable|string',
			'email' => 'nullable|string',
            'password' => 'nullable|string',
			'password' => 'nullable|string',
			'birth_date' => 'nullable|date',
			'gender' => 'nullable|string',
			'phone_number' => 'nullable|string',
			'location' => 'nullable|string',
			'profil_img_url' => 'nullable|string',
			'company_name' => 'nullable|string',
			'company_info' => 'nullable|string',
			'country_id' => 'nullable|integer',

        ];
    }
}
