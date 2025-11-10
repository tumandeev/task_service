<?php

namespace App\Services\Notification;

interface NotificationServiceInterface
{
    public function notify(int $userId, string $type, array $data = []): void;
}
