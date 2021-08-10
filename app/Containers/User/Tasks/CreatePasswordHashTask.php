<?php

namespace App\Containers\User\Tasks;

use Illuminate\Support\Facades\Hash;

class CreatePasswordHashTask
{
    /**
     * @param string $password
     * @return string
     */
    public function run(string $password): string
    {
        return Hash::make($password);
    }
}
