<?php

namespace App\Factories\Response;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

interface ApiResponseFactory
{
    public function makeFrom(Response $response): JsonResponse;
}
