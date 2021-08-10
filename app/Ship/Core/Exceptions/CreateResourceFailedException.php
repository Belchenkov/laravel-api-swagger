<?php

namespace App\Ship\Core\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class CreateResourceFailedException extends \Exception
{
    protected $code = Response::HTTP_EXPECTATION_FAILED;
    protected $message = 'Failed to create Resource.';
}
