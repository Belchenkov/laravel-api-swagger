<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\LoginAction;
use App\Containers\User\Actions\RegisterAction;
use App\Containers\User\Data\Dto\LoginDto;
use App\Containers\User\Data\Dto\RegisterDto;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends ApiController
{
    /**
     * @param LoginRequest $request
     * @param LoginAction $action
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        $dto = LoginDto::get($request->validated());
        $result = $action->run($dto);

        return response()->json($result->data, $result->code);
    }

    /**
     * @param RegisterRequest $request
     * @param RegisterAction $action
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $dto = RegisterDto::get($request->validated());
        $result = $action->run($dto);

        return response()->json($result->data, $result->code);
    }
}
