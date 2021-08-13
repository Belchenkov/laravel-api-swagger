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
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends ApiController
{
    /**
     * @OA\Get(path="/users",
     *     security={{"bearerAuth": {}}},
     *  @OA\Response(response="200",
     *     description="User Collection",
     *     )
     * )
     */
    /**
     * @param GetAllUsersAction $action
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(GetAllUsersAction $action): JsonResponse
    {
        Gate::authorize('view', 'users');

        $result = $action->run();
        return response()->json($result->data, $result->code);
    }

    /**
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        Gate::authorize('view', 'users');

        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request): Response
    {
        Gate::authorize('edit', 'users');

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
        Gate::authorize('edit', 'users');

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
        Gate::authorize('edit', 'users');

        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function user(): UserResource
    {
        $user = auth()->user();

        return (new UserResource($user))->additional([
            'data' => [
                'permissions' => $user->perms()
            ]
        ]);
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
