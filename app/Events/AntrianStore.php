<?php

namespace App\Events;

use auth;
use App\Models\Antrian;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Providers\AppServiceProvider;

class AntrianStore implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $antrian;
    public $data;
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
            'antrian'
        ];
    }
    public function broadcastAs()
    {
        return 'antrian-store';
    }

    public function broadcastWith()
    {
        $appServiceProvider = app(AppServiceProvider::class);
        $kuota = $appServiceProvider->getKuotaAntrian()[$this->antrian->jenis_antrian] ?? 0;
        return [
            'id' => $this->antrian->id,
            'id_user' => $this->antrian->id_user,
            'nama' => $this->antrian->user->nama,
            'batas_waktu' => $this->antrian->batas_waktu,
            'no_antrian' => $this->antrian->no_antrian,
            'status' => $this->antrian->status,
            'jenis_antrian' => $this->antrian->jenis_antrian,
            'kuota' => $kuota
        ];
    }
}
