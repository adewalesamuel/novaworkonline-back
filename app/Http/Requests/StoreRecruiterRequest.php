<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecruiterRequest extends FormRequest
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
			'email' => 'required|string||unique:recruiters',
			'password' => 'required|string',
			'birth_date' => 'nullable|date',
			'gender' => 'nullable|string',
			'phone_number' => 'nullable|string',
			'location' => 'nullable|string',
			'profil_img_url' => 'nullable|string',
			'company_name' => 'required|string',
			'company_info' => 'nullable|json',
			'country_id' => 'nullable|integer',

        ];
    }
}
