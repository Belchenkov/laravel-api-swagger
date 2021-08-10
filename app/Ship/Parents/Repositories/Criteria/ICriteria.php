<?php

namespace App\Ship\Parents\Repositories\Criteria;

interface ICriteria
{
    public function withCriteria(...$criteria): self;
}
