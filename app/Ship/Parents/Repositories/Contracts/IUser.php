<?php

namespace App\Ship\Parents\Repositories\Contracts;

interface IUser
{
    public function findByEmail(string $email);
}
