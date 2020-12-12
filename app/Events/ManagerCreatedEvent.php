<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Crypt;

class ManagerCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $manager_user;
    public $manager_pass_encrypted;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($manager_user, $manager_pass_encrypted)
    {
        $this->manager_user = $manager_user;
        $this->manager_pass_encrypted = $manager_pass_encrypted;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
