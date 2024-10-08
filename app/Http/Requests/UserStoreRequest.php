<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;


class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'reg_number' => ['nullable', 'string', 'unique:users,reg_number'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
            'user_avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'department_id' => ['required', 'numeric'],
        ];
    }
}
