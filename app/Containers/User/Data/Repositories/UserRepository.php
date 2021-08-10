<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Models\User;
use App\Ship\Parents\Repositories\Contracts\IUser;
use App\Ship\Parents\Repositories\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements IUser
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    public function findByEmail(string $email)
    {

    }
}
