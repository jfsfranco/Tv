<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

final class HealthCheckController
{
    public function __invoke()
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
