<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterviewRequestRequest extends FormRequest
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
            'status' => 'required|string',
			'recruiter_id' => 'required|integer|exists:recruiters,id,deleted_at,NULL',
            'user_id' => 'required|integer|exists:users,id,deleted_at,NULL',
            'description' => 'nullable|string',

        ];
    }
}
