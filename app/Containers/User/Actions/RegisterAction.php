<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Dto\LoginDto;
use App\Containers\User\Data\Dto\RegisterDto;
use App\Containers\User\Tasks\CreatePasswordHashTask;
use App\Containers\User\Tasks\CreateUserTask;
use App\Containers\User\UI\API\Resources\UserResource;
use App\Ship\Core\Helpers\ResponseData;
use App\Ship\Parents\Actions\ActionParent;
use App\Ship\Parents\Repositories\Contracts\IUser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RegisterAction extends ActionParent
{
    /**
     * @param RegisterDto $dto
     * @return object
     */
    public function run(RegisterDto $dto)
    {
        $dto->password = app(CreatePasswordHashTask::class)->run($dto->password);
        $user = app(CreateUserTask::class)->run($dto);

        return ResponseData::send(
            true,
            ['user' => new UserResource($user)],
            Response::HTTP_OK
        );
    }
}
