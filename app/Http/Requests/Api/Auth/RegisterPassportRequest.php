<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use App\Traits\Api\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterPassportRequest extends FormRequest
{
    use ResponseTrait;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
    }

    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(
            $this->responseError('Validation Error.', $validator->errors())
        );

    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'The User Email must be a valid email address',
            'password.required' => 'password is required'
        ];
    }
}

