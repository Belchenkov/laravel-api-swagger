<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\RequestParent;

class LoginRequest extends RequestParent
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
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
