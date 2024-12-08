<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'username' => 'required|max:64|min:3|alpha_num:ascii',
            'password' => 'required|min:5|alpha_num:ascii',
            'email' => 'required|email',
            'number'=>'required|numeric|starts_with:0|digits:11',
            'type'=>'required|in:pending,customer'
        ];
    }
}
