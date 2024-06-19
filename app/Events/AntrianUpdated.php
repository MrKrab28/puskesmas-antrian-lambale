<?php

namespace App\Events;

use App\Models\Antrian;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $antrian;
    /**
     * Create a new event instance.
     */
    public function __construct(Antrian $antrian)
    {
        $this->antrian = $antrian;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
       return ['antrian'];
    }

    public function broadcastAs()
    {
        return 'antrian-update';
    }

        public function broadcastWith()
        {
            $kuota = View::getSection('kuota')[$this->antrian->jenis_antrian] ?? 0;
            return [
                'id' => $this->antrian->id,
                'no_antrian' => $this->antrian->no_antrian,
                'status' => $this->antrian->status,
                'jenis_antrian' => $this->antrian->jenis_antrian,
                'kuota' => $kuota
            ];
        }
}
