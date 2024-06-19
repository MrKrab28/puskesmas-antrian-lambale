@extends('user.layout')


@section('content')
    <section id="counts" class="counts">
        <div class="container">
            <div class="section-title">
                <h2 style="color: #1977cc">Antrian Layanan</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>
            <div class="row">
                @php
                    $jenisAntrian = ['kia', 'umum', 'gigi'];

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
                            <p id="kuota-antrian-{{ $jenis }}" >Kuota Nomor Antrian Tersisa {{ $kuota[$jenis] }}</p>
                            @auth('user')
                                @if (!auth()->user()->antrian && $kuota[$jenis] > 0)
                                    <form action="{{ route('user-antrian.store', $jenis) }}" method="POST">
                                        @csrf
                                        <input type="text" value="{{ $jenis }}" name="jenis_antrian" hidden>
                                        <button class="btn btn-primary mt-2" type="submit">Ambil Antrian</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            Pusher.logToConsole = true;
            var pusher = new Pusher('31a00261f5424be7ca0c', {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('antrian');
            channel.bind('antrian-update', function(data) {
                if (data && data.jenis_antrian && data.no_antrian && data.kuota !== undefined) {
                    var jenisAntrianElement = document.getElementById('nomor-antrian-' + data.jenis_antrian);
                    if (jenisAntrianElement) {
                        // jenisAntrianElement.textContent = data.no_antrian;
                        jenisAntrianElement.innerHTML = `<span id="nomor-antrian-${data.jenis_antrian}" style="color: #1977cc">${data.jenis_antrian.charAt(0).toUpperCase()}-${data.no_antrian}</span>`;
                    }

                    var kuotaElement = document.getElementById('kuota-antrian-${data.jenis_antrian}');
                    if (kuotaElement) {
                        kuotaElement.textContent = `Kuota Nomor Antrian Tersisa ${data.kuota}`;
                    }
                } else {
                    console.error('Invalid data structure received:', data);
                }
            });
        });
        </script>
    </section>

    </script>
@endsection
{{-- @section('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('antrian');
        channel.bind('antrian.updated', function(data) {
            // Periksa apakah antrian yang diperbarui adalah milik pengguna saat ini
            @if (auth()->check() && auth()->user()->antrian)
                if (data.id === {{ auth()->user()->antrian->id }}) {
                    // Perbarui tampilan nomor antrian
                    document.getElementById('nomor-antrian').textContent = data.no_antrian;
                }
            @endif
        });
    </script>
@endsection --}}
