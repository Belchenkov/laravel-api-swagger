<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Dto\LoginDto;
use App\Ship\Core\Helpers\ResponseData;
use App\Ship\Parents\Actions\ActionParent;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginAction extends ActionParent
{
    /**
     * @param LoginDto $dto
     * @return object
     */
    public function run(LoginDto $dto): object
    {
        $user_attempt_data = [
            'email' => $dto->email,
            'password' => $dto->password
        ];

        if (Auth::attempt($user_attempt_data)) {
            if ($user = Auth::user()) {
                $token = $user->createToken('admin')->accessToken;

                return ResponseData::send(
                    true,
                    ['token' => $token],
                    Response::HTTP_OK
                );
            }
        }

        return ResponseData::send(
            false,
            ['error' => 'Invalid Credentials'],
            Response::HTTP_UNAUTHORIZED
        );
    }
}
