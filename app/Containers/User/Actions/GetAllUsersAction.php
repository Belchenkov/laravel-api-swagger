<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\GetAllUsersTask;
use App\Containers\User\UI\API\Resources\UserResource;
use App\Ship\Core\Helpers\ResponseData;
use App\Ship\Parents\Actions\ActionParent;
use Illuminate\Http\Response;

class GetAllUsersAction extends ActionParent
{
    public function run(): object
    {
        $users = app(GetAllUsersTask::class)->run();

        return ResponseData::send(
            true,
            [ 'users' => UserResource::collection($users)->resource ],
            Response::HTTP_OK
        );
    }
}
