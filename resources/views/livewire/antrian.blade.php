@script
    <script>
        let channel = pusher.subscribe('antrian');
        channel.bind('antrian-diambil', function(data) {
            console.log('Data received:', data);

            toastr.success(
                'Nama Lengkap : ' + data.nama + '<br>POLI: ' + data.jenis_antrian,
                'Pasien Telah Mendaftar Nomor Antrian', {
                    timeOut: 0,
                    extendedTimeOut: 0,
                }
            );

            $wire.$refresh()
        });
    </script>
@endscript


<div class="card text-nowrap">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="header-title">
            @if (!empty($daftarAntrian) && count($daftarAntrian) > 0)
                <h4 class="mb-0">Daftar Antrian Poli {{ strtoupper($daftarAntrian[0]->jenis_antrian) }}</h4>
            @else
                <h4 class="mb-0">Tidak ada antrian</h4>
            @endif
        </div>
        <div>
            <span id="waktu" class="mx-3">{{ Carbon\Carbon::now()->format('l, H:i:s') }} </span>
            @if ($daftarAntrian->contains('status', '!=', 'selesai'))
                <form action="{{ route('admin-antrian.updateStatus', $jenisAntrian) }}" method="post" class="d-inline">
                    @method('PUT')
                    @csrf

                    @php
                        $menunggu = $daftarAntrian->where('status', 'menunggu')->first();
                    @endphp



                    <button id="nextAntrianBtn" class="btn btn-dark">Next Antrian</button>
                </form>
            @endif
            <button type="submit" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                Data</button>

        </div>
    </div>
    <div class="card-body text-nowrap">
        <div class="table-reponsive">
            {{-- <table id="table" class="table table-striped mt-5" data-toggle="data-table"> --}}
            <table id="table" class="table table-hover mt-0" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>No Antrian</th>
                        <th>Status </th>
                        <th>Waktu Panggil </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarAntrian as $antrian)
                        <tr data-jenis-antrian={{ $antrian->jenis_antrian }}>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $antrian->user->nama }}</td>
                            <td>{{ strtoupper(Str::substr($antrian->jenis_antrian, 0, 1)) }}-{{ $antrian->no_antrian }}
                            </td>
                            <td>
                                @if ($antrian->status == 'menunggu')
                                    <span
                                        class="badge rounded-pill text-bg-warning">{{ ucfirst($antrian->status) }}</span>
                                @endif
                                @if ($antrian->status == 'dipanggil')
                                    <span
                                        class="badge rounded-pill text-bg-primary">{{ ucfirst($antrian->status) }}</span>
                                @endif
                                @if ($antrian->status == 'selesai')
                                    <span
                                        class="badge rounded-pill text-bg-success text-dark">{{ ucfirst($antrian->status) }}</span>
                                @endif
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($antrian->batas_waktu)->isoFormat('HH:mm') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $daftarAntrian->links() }}
        </div>
    </div>
</div>
