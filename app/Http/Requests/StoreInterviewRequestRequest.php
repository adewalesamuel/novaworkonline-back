<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequestRequest extends FormRequest
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
			'recruiter_id' => 'nullable|integer||exists:recruiters,id',
			'user_id' => 'required|integer||exists:users,id',
			'description' => 'nullable|string',

        ];
    }
}
