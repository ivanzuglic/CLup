<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class StoreEnterableNotification extends Notification implements ShouldQueue
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
            ->subject('CLup - Queue Notification')
            ->greeting("Hello, {$this->user->name}!")

            ->line(new HtmlString('You may enter the store <strong>' . $this->store->name . '</strong>.'))
            ->line(new HtmlString('<em>The previous customer in your lane exited the store.</em>'))
            ->line(new HtmlString('Your Appointment ID: <strong>' . $this->appointment->appointment_id . '</strong>'))

            ->action('QR-Code', url("/appointments/{$this->appointment->appointment_id}/details"))

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
