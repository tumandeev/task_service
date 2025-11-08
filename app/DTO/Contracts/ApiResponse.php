<?php

namespace App\DTO\Contracts;

use Illuminate\Http\JsonResponse;

interface ApiResponse
{
    public function toResponse(): JsonResponse;
}
