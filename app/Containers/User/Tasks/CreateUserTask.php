<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Dto\RegisterDto;
use App\Containers\User\Data\Repositories\Contracts\IUser;
use App\Ship\Core\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\TaskParent;

class CreateUserTask extends TaskParent
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

    /**
     * @throws CreateResourceFailedException
     */
    public function run(RegisterDto $dto)
    {
        try {
            return $this->repository->create($dto->toArray());
        } catch (\Exception $e) {
            throw new CreateResourceFailedException();
        }
    }
}
