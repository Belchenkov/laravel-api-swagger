<?php

namespace App\Containers\User\Data\Dto;

use App\Ship\Parents\Dto\DtoParent;

class LoginDto extends DtoParent
{
    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;
}
