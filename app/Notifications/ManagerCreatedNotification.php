<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class ManagerCreatedNotification extends Notification
{
    use Queueable;

    protected $manager_user;
    protected $manager_store;
    protected $manager_pass_decrypted;

    /**
     * Create a new notification instance.
     *
     * @return void
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('administration@clup.com', 'CLup')
                    ->greeting("Hello {$this->manager_user->name}!")
                    ->line('You have been registered as a store manager.')

                    ->line('Your Login Credentials Are:')
                    ->line("    EMAIL:      {$this->manager_user->email}")
                    ->line("    PASSWORD:   {$this->manager_pass_decrypted}")

                    ->line('You have been linked to the Store:')
                    ->line("    STORE NAME: {$this->manager_store->name}")
                    ->line("    ADDRESS:    {$this->manager_store->address_line_1}")
                    ->line("                {$this->manager_store->address_line_2}")
                    ->line("                {$this->manager_store->zip_code}, {$this->manager_store->town}")
                    ->line("                {$this->manager_store->country}")

                    ->action('Manager Dashboard', url('/manager/dashboard'))

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
