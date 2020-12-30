<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QueueCreatedNotification extends Notification  implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $store;
    protected $appointment;
    protected $appointment_start_time;
    protected $appointment_end_time;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $store
     * @param $appointment
     */
    public function __construct($user, $store, $appointment)
    {
        $this->user = $user;
        $this->store = $store;
        $this->appointment = $appointment;
        $this->appointment_start_time = date('H:i', strtotime($this->appointment->start_time));
        $this->appointment_end_time = date('H:i', strtotime($this->appointment->end_time));
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('notifications@CLup.com', 'CLup')
            ->subject('CLup - Queue-Up Confirmation')
            ->greeting("Hello, {$this->user->name}!")

            ->line(new HtmlString('You Queued-up at <strong>' . $this->store->name . '</strong>.'))
            ->line(new HtmlString('Your Appointment ID: <strong>' . $this->appointment->appointment_id . '</strong>'))
            ->line(new HtmlString('Current Time Estimate: <strong>' . $this->appointment_start_time . ' - ' . $this->appointment_end_time . '</strong>'))

            ->line(new HtmlString('If you wish to <strong>edit</strong> or <strong>delete</strong> your Queue Entry, you can do so on <strong>My&nbsp;Placements</strong> page.'))
            ->action('My Placements', url("/user/{$this->user->id}/placements"))

            ->line(new HtmlString('Thank you for using <strong>CLup</strong>!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
