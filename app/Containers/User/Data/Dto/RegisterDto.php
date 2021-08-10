<?php

namespace App\Containers\User\Data\Dto;

use App\Ship\Parents\Dto\DtoParent;

class RegisterDto extends DtoParent
{
    /**
     * @var string
     */
    public string $firstname;

    /**
     * @var string
     */
    public string $lastname;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

    /**
     * @var integer
     */
    public int $role_id;
}
