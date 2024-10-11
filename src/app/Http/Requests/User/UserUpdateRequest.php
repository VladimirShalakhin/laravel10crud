<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'min:3|max:39|alpha',
            'surname' => 'min:3|max:39|alpha',
            'phone_number' => 'unique:users,phone_number|regex:/^\+7\d{10}$/',
            'avatar' => 'mimes:png,jpg|max:2000',
        ];
    }
}
