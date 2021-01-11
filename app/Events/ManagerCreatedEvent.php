<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ManagerCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $manager_user;
    public $manager_pass_encrypted;

    /**
     * Create a new event instance.
     *
     * @param $manager_user
     * @param $manager_pass_encrypted
     */
    public function __construct($manager_user, $manager_pass_encrypted)
    {
        $this->manager_user = $manager_user;
        $this->manager_pass_encrypted = $manager_pass_encrypted;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }
}
