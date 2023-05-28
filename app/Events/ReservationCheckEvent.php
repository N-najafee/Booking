<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationCheckEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $reserves;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($reserves)
    {
        $this->reserves = $reserves;
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
