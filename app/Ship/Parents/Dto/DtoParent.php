<?php

namespace App\Ship\Parents\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class DtoParent extends DataTransferObject
{
    /**
     * @param array $data
     * @return static
     * @throws UnknownProperties
     */
    public static function get(array $data): static
    {
        return new static($data);
    }
}
