<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
			'slug' => 'required|string',
			'description' => 'required|string',
			'content' => 'required|string',
			'type' => 'required|string',
			'estimated_length' => 'required|string',
			'cover_img_url' => 'required|string',
			'course_id' => 'required|integer',
			
        ];
    }
}