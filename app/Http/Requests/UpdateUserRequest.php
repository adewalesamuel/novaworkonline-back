<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
			'email' => 'nullable|email',
			'password' => 'nullable|string',
			'birth_date' => 'nullable|date',
			'gender' => 'nullable|string',
			'phone_number' => 'nullable|string',
			'city' => 'nullable|string',
			'profil_img_url' => 'nullable|string',
			'country_id' => 'nullable|integer|exists:countries,id',
			'job_title_id' => 'nullable|integer|exists:job_titles,id',
            'certificat_url' => 'nullable|string',
			'video_url' => 'nullable|string',
			'score' => 'nullable|integer',
			'course_link' => 'nullable|string',
			'course_login' => 'nullable|string',
			'course_password' => 'nullable|string',

        ];
    }
}
