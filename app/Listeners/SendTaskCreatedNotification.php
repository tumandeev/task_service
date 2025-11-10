<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Services\Notification\NotificationServiceInterface;

class SendTaskCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public NotificationServiceInterface $notificationService
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event): void
    {
        $task = $event->task;

        if (is_int($task->executor)) {
            $this->notificationService->notify($task->executor, 'task.assigned', [
                'task' => $task,
            ]);
        }
    }
}
