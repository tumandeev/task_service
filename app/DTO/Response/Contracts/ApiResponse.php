<?php

namespace App\DTO\Response\Contracts;

use Illuminate\Http\JsonResponse;

interface ApiResponse
{
    public function toResponse(): JsonResponse;
}
