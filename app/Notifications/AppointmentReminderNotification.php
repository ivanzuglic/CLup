<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $store;
    protected $appointment;
    protected $start_time;
    protected $end_time;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $store, $appointment)
    {
        $this->user = $user;
        $this->store = $store;
        $this->appointment = $appointment;

        $this->start_time = date('H:i', strtotime($this->appointment->start_time));
        $this->end_time = date('H:i', strtotime($this->appointment->end_time));
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('administration@clup.com', 'CLup')
            ->greeting("Hello, {$this->user->name}!")

            ->line("Your appointment at {$this->store->name} starts in less than 30 minutes.")
            ->line("Current Appointment Time: {$this->start_time} - {$this->end_time}")

            ->line("If you can not make the appointment, you should reschedule or delete the appointment")
            ->action('My Placements', url("/user/{$this->user->id}/placements"))

            ->line('Thank you for using CLup!');
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
