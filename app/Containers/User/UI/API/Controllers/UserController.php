<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\GetAllUsersAction;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\UpdateInfoRequest;
use App\Containers\User\UI\API\Requests\UpdatePasswordRequest;
use App\Containers\User\UI\API\Requests\UserCreateRequest;
use App\Containers\User\UI\API\Requests\UserUpdateRequest;
use App\Containers\User\UI\API\Resources\UserResource;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends ApiController
{
    /**
     * @param GetAllUsersAction $action
     * @return JsonResponse
     */
    public function index(GetAllUsersAction $action): JsonResponse
    {
        $result = $action->run();
        return response()->json($result->data, $result->code);
    }

    /**
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request): Response
    {
        $user = User::create($request->only('firstname', 'lastname', 'email', 'role_id') + [
            'password' => Hash::make('12qwasZX')
        ]);

        return response($user, Response::HTTP_CREATED);
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UserUpdateRequest $request, int $id): Response
    {
        $user = User::findOrFail($id);
        $user->update($request->only('firstname', 'lastname', 'email', 'role_id'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function user()
    {
        return \Auth::user();
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        if (!$user = \Auth::user()) {
            return new NotFoundHttpException('User is not found');
        }

        $user->update($request->only('firstname', 'lastname', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if (!$user = \Auth::user()) {
            return new NotFoundHttpException('User is not found');
        }

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return response($user, Response::HTTP_ACCEPTED);
    }
}
