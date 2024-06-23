<?php

namespace App\Events;

use App\Models\Antrian;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianStored implements ShouldBroadcast
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
    public function broadcastOn(): array
    {
        return [
            new Channel('antrian'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'antrian-diambil';
    }

    public function broadcastWith(): array
    {
        return [
            'nama' => $this->antrian->user->nama,
            'jenis_antrian' => $this->antrian->jenis_antrian,
            'no_antrian' => $this->antrian->no_antrian
        ];
    }
}
