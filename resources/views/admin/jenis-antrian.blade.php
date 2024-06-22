@extends('admin.layout')


@section('content')
    <div class="container-fluid content-inner mt-2">
        <div class="row">
            <div class="col-sm-3">
                <div class="card bg bg-danger  rounded-3">

                    @php
                        $jenisAntrian = Request::get('jenis_antrian');
                        $currentAntrian = App\Models\Antrian::where('status', 'dipanggil')
                            ->where('jenis_antrian', $jenisAntrian)
                            ->whereDate('created_at', Carbon\Carbon::today())
                            ->latest('updated_at')
                            ->first();
                        $jenis_antrian = $currentAntrian;
                    @endphp
                    @if ($jenis_antrian)
                        <div class="card-body">

                            <h3 class="fs-6 fw-bolder text-light">Antrian Saat Ini</h3>
                            <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">
                            <h3 class="fs-8 text-light mb-0 text-center">
                                {{ strtoupper(Str::substr($jenis_antrian->jenis_antrian, 0, 1)) }}-{{ $jenis_antrian->no_antrian }}
                            </h3>
                        </div>
                    @else
                        <div class="card-body">

                            <h3 class="fs-6 fw-bolder text-light my-0">Antrian Saat Ini</h3>
                            <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">
                            <h3 class="fs-8 text-light mb-0 text-center">
                                {{ strtoupper(Str::substr($jenisAntrian, 0, 1)) }}-0
                            </h3>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-primary rounded-3">
                    <div class="card-body">
                        <h3 class="fs-6 fw-bolder text-light">Antrian Dipanggil</h3>
                        <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">
                        @php
                            $jenisAntrian = Request::get('jenis_antrian');
                            $currentAntrian = App\Models\Antrian::where('status', 'dipanggil')
                                ->where('jenis_antrian', $jenisAntrian)
                                ->whereDate('created_at', Carbon\Carbon::now())
                                ->latest('updated_at')
                                ->first();
                        @endphp
                        @if ($currentAntrian)
                            <h3 class="fs-8 text-light mb-0 text-center">
                                {{ strtoupper(Str::substr($currentAntrian->jenis_antrian, 0, 1)) }}-{{ $currentAntrian->no_antrian }}
                            </h3>
                        @else
                            <h3 class="fs-8 text-light mb-0 text-center">
                                {{ strtoupper(Str::substr($jenisAntrian, 0, 1)) }}-0
                            </h3>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-warning rounded-3">
                    <div class="card-body">
                        <h3 class="fs-6 fw-bolder text-light">Antrian Menunggu</h3>
                        <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">
                        @php
                            $jenisAntrian = Request::get('jenis_antrian');
                            $antrianMenunggu = App\Models\Antrian::where('status', 'menunggu')
                                ->where('jenis_antrian', $jenisAntrian)
                                ->whereDate('created_at', Carbon\Carbon::now())
                                ->count();
                        @endphp
                        <h3 class="fs-8 text-light mb-0 text-center">{{ $antrianMenunggu }} </h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-success rounded-3">
                    <div class="card-body">
                        <h3 class="fs-6 fw-bolder text-dark">Antrian Selesai</h3>
                        <hr style="color: white;border:3px solid black;border-widht:100%" class="my-1">
                        @php
                            $jenisAntrian = Request::get('jenis_antrian');
                            $antrianSelesai = App\Models\Antrian::where('status', 'selesai')
                                ->where('jenis_antrian', $jenisAntrian)
                                ->whereDate('created_at', Carbon\Carbon::now())
                                ->count();
                        @endphp
                        <h3 class="fs-8 text-dark mb-0 text-center">{{ $antrianSelesai }} </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @livewire('antrian', ['jenisAntrian' => request()->get('jenis_antrian')])
            </div>

        </div>
    </div>
    {{-- <script>
        let remainingSeconds = {{ $antrian->where('status', 'menunggu')->first()->remaining_seconds ?? 0 }};
        let countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            if (remainingSeconds > 0) {
                remainingSeconds--;
                let minutes = Math.floor(remainingSeconds / 60);
                let seconds = remainingSeconds % 60;
                countdownElement.textContent =
                    `Waktu tunggu: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            } else {
                countdownElement.textContent = 'Silahkan memanggil antrian selanjutnya';
                clearInterval(countdownInterval);
            }
        }

        let countdownInterval = setInterval(updateCountdown, 1000);
    </script> --}}
    <input type="hidden" id="jenis_table" value="{{ request('jenis_antrian') }}"
        placeholder="{{ request('jenis_antrian') }}">

    <script>
        function updateJam() {
            var sekarang = new Date(); // Mendapatkan waktu saat ini
            var hari = sekarang.toLocaleDateString('id-ID', {
                weekday: 'long'
            }); // Nama hari dalam bahasa Indonesia
            var jam = sekarang.getHours();
            var menit = sekarang.getMinutes();
            var detik = sekarang.getSeconds();

            // Format jam agar selalu dua digit (misal: 09:05:02)
            jam = (jam < 10 ? "0" : "") + jam;
            menit = (menit < 10 ? "0" : "") + menit;
            detik = (detik < 10 ? "0" : "") + detik;

            // Menyusun teks waktu yang akan ditampilkan
            var waktu = hari + ', ' + jam + ':' + menit + ':' + detik;

            // Memasukkan teks waktu ke dalam elemen dengan id="waktu"
            document.getElementById("waktu").innerHTML = waktu;
        }

        // Memanggil fungsi updateJam() setiap detik (1000 milidetik)
        setInterval(updateJam, 1000);
    </script>
@endsection
@push('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin-antrian.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK Pasien</label>
                            <select class="form-select" id="user" name="id_user" required>
                                <option value="">Pilih</option>
                                @foreach ($daftarUser as $user)
                                    <option value="{{ $user->id }}" data-nama="{{ $user->nama }}"
                                        data-alamat="{{ $user->alamat }}" data-email="{{ $user->email }}"
                                        data-no_hp="{{ $user->no_hp }}" name="id_user">{{ $user->nik }} ||-||
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" autocomplete="off" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" autocomplete="off" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" autocomplete="off" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control" id="no_hp" autocomplete="off" readonly>
                        </div>

                        <input type="hidden" value="{{ Request::get('jenis_antrian') }}" name="jenis_antrian" required>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#user').addEventListener('change', function() {
            console.log(this.options)
            document.querySelector('#nama').value = this.options[this.selectedIndex].getAttribute('data-nama')
            document.querySelector('#alamat').value = this.options[this.selectedIndex].getAttribute('data-alamat')
            document.querySelector('#email').value = this.options[this.selectedIndex].getAttribute('data-email')
            document.querySelector('#no_hp').value = this.options[this.selectedIndex].getAttribute('data-no_hp')
        })
    </script>
@endpush
@push('styles')
    @include('includes.choices-js.styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('31a00261f5424be7ca0c', {
            cluster: 'ap1'
        });

        function reloadDataTable() {
            $('#table').DataTable().clear().destroy();
            initDataTable();
        }

        function formatTime(time) {
            var date = new Date(time);
            var hours = date.getHours();
            var minutes = date.getMinutes();
            return (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;
        }
    </script>
@endpush

@push('scripts')
    @include('includes.choices-js.scripts')

    <script>
        function deleteData(id) {
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data Ini Akan Terhapus Dari Database",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formDelete' + id).submit()
                }
            });
        }
    </script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
@endpush
