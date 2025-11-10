<?php

namespace App\Services\Notification;

use App\Models\User;
use App\Notifications\TaskAssignedNotification;

class EloquentUserNotificationService implements NotificationServiceInterface
{
    public function notify(int $userId, string $type, array $data = []): void
    {
        $user = User::find($userId);

        if (!$user) {
            return;
        }

        match ($type) {
            'task.assigned' => $user->notify(new TaskAssignedNotification($data['task'])),
            default => null,
        };
    }
}
