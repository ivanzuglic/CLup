<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QueueCreatedNotification extends Notification  implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $appointment;
    protected $store;
    protected $appointment_start_time;
    protected $appointment_end_time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $appointment, $store)
    {
        $this->user = $user;
        $this->appointment = $appointment;
        $this->store = $store;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('administration@CLup.com', 'CLup')
            ->greeting("Hello {$this->user->name}!")
            ->line("Your appointment at {$this->store->name} has been recorded!")
            ->line("Appointment Time: {$this->appointment_start_time} - {$this->appointment_end_time}")
            ->line("Store Address: {$this->store->address_line_1}")
            ->action('Start using CLup!', url('/home'))
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
