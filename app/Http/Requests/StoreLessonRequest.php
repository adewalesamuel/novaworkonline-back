<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'name' => 'required|string',
			'description' => 'nullable|string',
			'content' => 'required|json',
			'type' => 'required|string',
			'estimated_length' => 'nullable|string',
			'cover_img_url' => 'nullable|string',
			'course_id' => 'required|integer|exists:courses',

        ];
    }
}
