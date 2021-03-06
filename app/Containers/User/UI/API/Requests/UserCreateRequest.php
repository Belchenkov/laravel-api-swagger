<?php

namespace App\Containers\User\UI\API\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;


/**
 * Class UserCreateRequest
 * @package App\Http\Requests
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property int $role_id
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
        return Gate::allows('view', 'users');
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
