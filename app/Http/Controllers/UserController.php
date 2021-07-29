<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
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
        $user = User::create($request->only('firstname', 'lastname', 'email') + [
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
        $user->update($request->only('firstname', 'lastname', 'email'));

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

    /**
     * @return User
     */
    public function user(): User
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
