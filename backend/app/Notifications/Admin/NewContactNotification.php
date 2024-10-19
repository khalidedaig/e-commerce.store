<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use App\Enums\NotificationType;
use App\Traits\MakeNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewContactNotification extends Notification
{
    use Queueable, MakeNotification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private \App\Models\Contact $contact) {}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->greeting('Hello!')
            ->subject('New Contact Message')
            ->line("A new contact message received from {$this->contact->name}")
            ->line("Email: {$this->contact->email}")
            ->line("Message: {$this->contact->value}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return  $this->make([
            "title"    => "A new contact message",
            "subtitle" => "Customer Name: {$this->contact->name}",
            "link"     => "/admin/contacts/{$this->contact->id}",
            "type"     => NotificationType::INFO(),
        ]);
    }
}
