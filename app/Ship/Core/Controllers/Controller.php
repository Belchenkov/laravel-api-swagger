<?php

namespace App\Ship\Core\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(
     *   title="API Documentation",
     *   version="1.0.0",
     *   description="Admin OpenApi description",
     *   @OA\Contact(
     *     email="u608110@gmail.com"
     *   ),
     * )
     *
     * @OA\Server(
     *     url="http://localhost:8000",
     *     description="Admin API Server"
     * )
     */
}
