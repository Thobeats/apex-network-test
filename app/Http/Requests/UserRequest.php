<?php

namespace App\Http\Requests;

use App\Trait\HttpResponses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
{
    use HttpResponses;

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
            /**
             * The new user's name
             * @var string
             * @example John 
             * 
             */
            "name" => "required|string|min:3",
            /**
             * The new user's email
             * @var string
             * @example John@example.com 
             * 
             */
            "email" => "required|email",
            /**
             * The new user's password
             * @var string
             * @example 123Password
             * 
             */
            "password" => "required|string|min:8",
            /**
             * The new user's role: 1 for Admin, 2 for User
             * @var integer
             * @example 1
             * 
             */
            "role" => "required|exists:roles,id"
        ];
    }

    /**
     * Return the validation response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($validator->errors(), "Validation Error", 422));
    }
}
