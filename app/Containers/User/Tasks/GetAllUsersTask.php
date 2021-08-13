<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\Contracts\IUser;
use App\Ship\Parents\Tasks\TaskParent;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllUsersTask extends TaskParent
{
    /**
     * @var IUser
     */
    protected IUser $repository;

    /**
     * @param IUser $repository
     */
    public function __construct(IUser $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $per_page = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($per_page);
    }
}
