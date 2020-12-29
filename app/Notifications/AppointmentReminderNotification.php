<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class AppointmentReminderNotification extends Notification implements ShouldQueue
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
            ->from('notifications@clup.com', 'CLup')
            ->subject('CLup - Appointment Reminder')
            ->greeting("Hello, {$this->user->name}!")

            ->line(new HtmlString('Your appointment at <strong>' . $this->store->name . '</strong> starts in <strong>less than 30 minutes</strong>.'))
            ->line(new HtmlString('Appointment Timeslot: <strong>' . $this->appointment_start_time . ' - ' . $this->appointment_end_time . '</strong>'))

            ->line(new HtmlString('If you can not make the appointment, you can <strong>reschedule</strong> it or <strong>delete</strong> it on <strong>My&nbsp;Placements</strong> page.'))
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
