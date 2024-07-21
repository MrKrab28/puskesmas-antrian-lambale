@script
    <script>
        let channel = pusher.subscribe('antrian');
        channel.bind('antrian-diperbarui', function(data) {
            console.log('Data received:', data);

            $wire.$refresh()
        });
    </script>
@endscript

<div class="row">

    @php
        $closedAntrian = [];
        foreach ($jenisAntrian as $jenis) {
            if (Cache::has('antrian_' . $jenis . '_tutup')) {
                $closedAntrian[$jenis] = Cache::get('antrian_' . $jenis . '_tutup');
            }
        }
    @endphp

    @foreach ($jenisAntrian as $jenis)
        <div class="col-lg-4 col-md-6 mt-5">
            <div class="count-box" style="border-radius: 20px">
                @if ($jenis == 'kia')
                    <i class="ti ti-baby-carriage"></i> 
                @elseif ($jenis == 'umum')
                    <i class="fa fa-user-md "></i>
                @elseif ($jenis = 'gigi')
                    <i class="ti ti-dental"></i>
                @endif
                <span
                    id="nomor-antrian-{{ $jenis }}">{{ strtoupper(Str::substr($jenis, 0, 1)) }}-{{ $data_antrian[$jenis] }}
                </span>
                <h4>POLI {{ strtoupper($jenis) }} </h4>
                @if (isset($closedAntrian[$jenis]))
                    <p id="antrian-closed-{{ $jenis }}" class="text-danger fw-bold">Mohon Maaf</p>
                    @else
                    <p id="kuota-antrian-{{ $jenis }}">Kuota Nomor Antrian Tersisa {{ $kuota[$jenis] }}</p>
                @endif
                <div id="antrian-action-{{ $jenis }}">
                    @auth('user')
                        @php
                            $antrian = auth()
                                ->user()
                                ->antrian()
                                ->whereIn('status', ['menunggu', 'dipanggil'])
                                ->whereDate('created_at', Carbon\Carbon::today())
                                ->first();
                        @endphp
                        @if (!$antrian && $kuota[$jenis] > 0 && !isset($closedAntrian[$jenis]))
                            <form action="{{ route('user-antrian.store', $jenis) }}" method="POST">
                                @csrf
                                <input type="text" value="{{ $jenis }}" name="jenis_antrian" hidden>
                                <button class="btn btn-primary mt-2" type="submit">Ambil Antrian</button>
                            </form>
                        @endif
                    @endauth
                </div>
                @if (isset($closedAntrian[$jenis]))
                    <p id="antrian-closed-{{ $jenis }}" class="text-danger fw-bold">
                        Antrian POLI-{{ strtoupper($jenis) }} sedang ditutup
                    </p>
                @endif
            </div>
        </div>
    @endforeach
</div>
