<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AppointmentDeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appointment_id;

    /**
     * Create a new event instance.
     *
     * @param $appointment_id
     */
    public function __construct($appointment_id)
    {
        $this->appointment_id = $appointment_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
