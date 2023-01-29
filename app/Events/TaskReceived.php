<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $task;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($task = null)
    {
        $this->task = $task;
    }


    public function broadcastWith()
    {
        //echo"broadcastWith";
        return ['task' => $this->task];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public');
    }


}
