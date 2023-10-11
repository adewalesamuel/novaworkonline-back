<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserTestRequest extends FormRequest
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
            'test_id' => 'required|integer|exists:tests,id',
			'user_id' => 'nullable|integer|exists:users,id',
			'current_step' => 'required|integer',
			'score' => 'required|integer',
        ];
    }
}
