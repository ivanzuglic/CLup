<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\HtmlString;

class ManagerCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $manager_user;
    protected $manager_store;
    protected $manager_pass_decrypted;

    /**
     * Create a new notification instance.
     *
     * @param $manager_user
     * @param $manager_store
     * @param $manager_pass_encrypted
     */
    public function __construct($manager_user, $manager_store, $manager_pass_encrypted)
    {
        $this->manager_user = $manager_user;
        $this->manager_store = $manager_store;
        $this->manager_pass_decrypted = Crypt::decryptString($manager_pass_encrypted);
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
            ->subject('CLup - Store Manager Account Details')
            ->greeting("Hello, {$this->manager_user->name}!")

            ->line(new HtmlString('You have been registered as a <strong>Store&nbsp;Manager</strong>.'))

            ->line(new HtmlString('Your <strong>Login Credentials</strong> are:'))
            ->line(new HtmlString('&nbsp;&nbsp;&nbsp;&nbsp;<strong>email: </strong>' . $this->manager_user->email))
            ->line(new HtmlString('&nbsp;&nbsp;&nbsp;&nbsp;<strong>password: </strong>' . $this->manager_pass_decrypted))
            ->line(new HtmlString('<em>It is strongly recommended you change your password as soon as possible!</em>'))

            ->line(new HtmlString('You have been linked to <strong>' . $this->manager_store->name . '</strong>.'))

            ->action('Manager Dashboard', url("/manager/dashboard/store_parameters/{$this->manager_store->store_id}"))

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
