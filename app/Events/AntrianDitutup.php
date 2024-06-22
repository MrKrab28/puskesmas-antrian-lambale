<?php

namespace App\Events;

use App\Models\Antrian;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\View;


class AntrianDitutup implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $antrian;
    public $isClosed;
    public $jenisAntrian;
    /**
     * Create a new event instance.
     */
    public function __construct(?Antrian $antrian = null, $isClosed = false, $jenisAntrian = null)
    {
        $this->antrian = $antrian;
        $this->isClosed = $isClosed;
        $this->jenisAntrian = $jenisAntrian ?? ($antrian ? $antrian->jenis_antrian : null);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['antrian'];
    }

    public function broadcastAs()
    {
        return 'antrian-tombol.tutup';
    }

    public function broadcastWith()
    {

        if ($this->isClosed !== null) {
            return [
                'isClosed' => $this->isClosed,
                'jenis_antrian' => $this->jenisAntrian
            ];
        }

        if (!$this->antrian) {
            return [];
        }
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
