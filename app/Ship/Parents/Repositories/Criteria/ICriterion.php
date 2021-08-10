<?php

namespace App\Ship\Parents\Repositories\Criteria;

interface ICriterion
{
    public function apply($model);
}
