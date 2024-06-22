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
    public $isClosed;
    public $jenisAntrian;
    public $kuota;
    /**
     * Create a new event instance.
     */
    public function __construct(?Antrian $antrian = null, $isClosed = false, $jenisAntrian = null, $kuota = null)
    {
        $this->antrian = $antrian;
        $this->isClosed = $isClosed;
        $this->jenisAntrian = $jenisAntrian ?? ($antrian ? $antrian->jenis_antrian : null);
        $this->kuota = $kuota;
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

        if($this->isClosed !== null){
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
        // $data = [
        //     'jenis_antrian' => $this->jenisAntrian,
        //     'isClosed' => $this->isClosed,
        // ];

        // if ($this->antrian) {
        //     $data += [
        //         'id' => $this->antrian->id,
        //         'no_antrian' => $this->antrian->no_antrian,
        //         'status' => $this->antrian->status,
        //     ];
        // }

        // if ($this->kuota !== null) {
        //     $data['kuota'] = $this->kuota;
        // }

        // return $data;
    }
}
