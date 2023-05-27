<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function failedValidation(Validator $validator)
    {
        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required'
            ],
            'mobile_no' => [
                'required',
                // 'unique:customers,mobile_no,except,'.request()->route('id'),
                Rule::unique('customers')->ignore($this->route('id'), 'id')
            ],
            'email' => [
                'sometimes',
                'email'
            ]
        ];
    }
}
