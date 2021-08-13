<?php

namespace App\Containers\Role\UI\API\Controllers;

use App\Containers\Role\Models\Role;
use App\Containers\Role\UI\API\Requests\RoleRequest;
use App\Containers\Role\UI\API\Resources\RoleResource;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class RoleController extends ApiController
{
     /**
     * @return AnonymousResourceCollection
      */
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('view', 'roles');

        return RoleResource::collection(Role::all());
    }

    /**
     * @param RoleRequest $request
     * @return Response
     */
    public function store(RoleRequest $request): Response
    {
        Gate::authorize('edit', 'roles');

        $role = Role::create($request->only('name'));

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                \DB::table('role_permission')->insert([
                   'role_id' => $role->id,
                   'permission_id' => $permission_id,
                ]);
            }
        }

        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @return RoleResource
     */
    public function show(int $id): RoleResource
    {
        Gate::authorize('view', 'roles');

        return new RoleResource(Role::find($id));
    }

    /**
     * @param RoleRequest $request
     * @param int $id
     * @return Response
     */
    public function update(RoleRequest $request, int $id): Response
    {
        Gate::authorize('edit', 'roles');

        $role = Role::find($id);
        $role->update($request->only('name'));

        \DB::table('role_permissions')
            ->where('role_id', $role->id)
            ->delete();

        if ($permissions = $request->input('permissions')) {
            foreach ($permissions as $permission_id) {
                \DB::table('role_permission')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        return response(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Gate::authorize('edit', 'roles');

        \DB::table('role_permissions')
            ->where('role_id', $id)
            ->delete();

        Role::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
