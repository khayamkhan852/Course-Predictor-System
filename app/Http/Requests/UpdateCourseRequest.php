<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'code' => ['required', 'string'],
            'title' => ['required', 'string'],
            'credit_hours' => ['required', 'numeric', 'min:1'],
            'department_id' => ['required', 'numeric'],
            'course_id' => ['nullable', 'numeric'],
            'coordinator_id' => ['nullable', 'numeric'],
            'course_level' => ['required', 'string', 'in:BS,MS,PhD'],
            'course_instructors.*.section_id' => ['nullable', 'numeric'],
            'course_instructors.*.instructor_id' => ['required_with:course_instructors.*.section_id']
        ];
    }

    public function messages()
    {
        return [
            'course_instructors.*.instructor_id.required_with' => 'The Course Instructor field is required when you select Section.',
        ];
    }
}
