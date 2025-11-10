<?php
namespace App\Notifications;

use App\Domain\Task\DTO\TaskData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification /* implements ShouldQueue */
{
    use Queueable;

    public function __construct(public TaskData $task) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New task: ' . $this->task->title)
            ->greeting('Hello, ' . $notifiable->name)
            ->line('A new task has been assigned to you.')
            ->line('Project: ' . $this->task->project)
            ->line('Description: ' . $this->task->description);
    }
}
