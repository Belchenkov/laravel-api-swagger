<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserCreateRequest
 * @package App\Http\Requests
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 */
class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'role_id' => 'required|integer|exists:roles,id',
            'email' => 'required|email|unique:users,email'
        ];
    }
}
