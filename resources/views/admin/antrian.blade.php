@extends('admin.layout')

@section('content')
    <div class="row">
        @foreach ($data_antrian as $jenis_antrian => $jumlah_antrian)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">

                        <div
                            class="card-header  @if ($jenis_antrian == 'kia') bg-primary text-light
                                    @elseif ($jenis_antrian == 'umum')
                                   bg-success text-dark
                                    @elseif ($jenis_antrian = 'gigi')
                                    bg-danger @endif bg-primary rounded">
                            <h3 class="text-light text-center">

                                <button onclick="document.location.href = '?jenis_antrian={{ $jenis_antrian }}'"
                                    class="btn btn-@if ($jenis_antrian == 'kia') primary text-white @elseif($jenis_antrian == 'umum')success text-dark @elseif($jenis_antrian == 'gigi')danger text-white @endif">
                                    @if ($jenis_antrian == 'kia')
                                        <i class="ti ti-baby-carriage"></i>
                                    @elseif ($jenis_antrian == 'umum')
                                        <i class="ti ti-first-aid-kit"></i>
                                    @elseif ($jenis_antrian = 'gigi')
                                        <i class="ti ti-dental"></i>
                                    @endif
                                    POLI {{ strtoupper($jenis_antrian) }}
                                </button>
                            </h3>
                        </div>
                        <div class="mt-3">

                            <h3 class="text-center text-primary">Jumlah Antrian </h3>
                            <h3 class="text-center">{{ $jumlah_antrian->count() }}</h3>
                        </div>
                        <div class="mt-3 text-center">
                            @if (!$antrian_tutup[$jenis_antrian])
                                <form action="{{ route('admin.tutup-antrian', $jenis_antrian) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Tutup Antrian
                                        {{ strtoupper($jenis_antrian) }}</button>
                                </form>
                            @else
                                <p class="text-danger font-weight-bold">Antrian {{ strtoupper($jenis_antrian) }} sedang
                                    ditutup</p>
                                <form action="{{ route('admin.buka-antrian', $jenis_antrian) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Buka Antrian
                                        {{ strtoupper($jenis_antrian) }}</button>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

        {{-- <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary rounded">
                        <h3 class="text-light"><button onclick="document.location.href = '?jenis_antrian=umum'" class="btn btn-primary text-white">POLI UMUM </button></h3>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">

                            <h3>Jumlah Antrian :</h3>
                            <h3 class="text-center">{{ $umum->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary rounded">
                        <h3 class="text-light"><button onclick="document.location.href = '?jenis_antrian=kia'" class="btn btn-primary text-white">POLI KIA </button></h3>
                    </div>
                    <div class="mb-3">

                            <h3>Jumlah Antrian :</h3>
                            <h3 class="text-center">{{ $kia->count() }}</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}


    </div>
    @push('scripts')
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            Pusher.logToConsole = true;
            var pusher = new Pusher('31a00261f5424be7ca0c', {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('antrian');

            channel.bind('antrian-update', function(data) {
                if (data.isClosed !== undefined) {
                    updateAntrianControl(data.jenis_antrian, data.isClosed);
                }
            });

            function updateAntrianControl(jenisAntrian, isClosed) {
                var controlElement = document.getElementById('antrian-control-' + jenisAntrian);
                if (controlElement) {
                    if (isClosed) {
                        controlElement.innerHTML = `
                            <p class="text-danger font-weight-bold">Antrian ${jenisAntrian.toUpperCase()} sedang ditutup</p>
                            <form action="/admin/buka-antrian/${jenisAntrian}" method="POST" class="buka-antrian-form">
                                @csrf
                                <button type="submit" class="btn btn-success">Buka Antrian ${jenisAntrian.toUpperCase()}</button>
                            </form>
                        `;
                    } else {
                        controlElement.innerHTML = `
                            <form action="/admin/tutup-antrian/${jenisAntrian}" method="POST" class="tutup-antrian-form">
                                @csrf
                                <button type="submit" class="btn btn-danger">Tutup Antrian ${jenisAntrian.toUpperCase()}</button>
                            </form>
                        `;
                    }
                }
            }
            document.addEventListener('submit', function(e) {
                if (e.target.classList.contains('tutup-antrian-form') || e.target.classList.contains(
                        'buka-antrian-form')) {
                    e.preventDefault();
                    fetch(e.target.action, {
                            method: 'POST',
                            body: new FormData(e.target),
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update akan dilakukan melalui Pusher event
                            } else {
                                alert('Terjadi kesalahan: ' + data.message);
                            }
                        });
                }
            });
        </script>
    @endpush
@endsection
