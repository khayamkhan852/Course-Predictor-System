<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessSettingRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'contact_one' => ['required', 'string'],
            'contact_two' => ['nullable', 'string'],
            'licence_number' => ['nullable', 'string'],
            'website_url' => ['nullable', 'url'],
            'address' => ['required'],
            'branch_id' => ['required'],
            'business_logo' => ['image', 'mimes:jpg,png,jpeg']
        ];
    }
}
