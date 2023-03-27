<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePartnerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:60'],
            'cell' => ['nullable'],
            'email' => ['nullable', 'email', 'unique:partners'],
            'address' => ['nullable'],
            'branch_id' => ['required'],
            'partner_image' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048'],
        ];
    }
}
