@extends('admin.layout')


@section('content')
    <div class="container-fluid content-inner mt-2">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">

                    @php
                        $jenisAntrian = Request::get('jenis_antrian');
                        $currentAntrian = App\Models\Antrian::where('status', 'dipanggil')
                            ->where('jenis_antrian', $jenisAntrian)
                            ->latest('updated_at')
                            ->first();
                        $jenis_antrian = $currentAntrian;
                    @endphp
                    @if ($jenis_antrian)
                        <div class="card-body bg bg-primary rounded-pill">

                            <h3 class=" text-light">Antrian Saat Ini</h3>
                            <h3 class="text-center text-light">
                                {{ strtoupper(Str::substr($jenis_antrian->jenis_antrian, 0, 1)) }}-{{ $jenis_antrian->no_antrian }}
                            </h3>
                        </div>
                        @else
                        <div class="card-body bg bg-primary rounded-pill">

                            <h3 class=" text-light">Antrian Saat Ini</h3>
                            <h3 class="text-center text-light">
                                {{ strtoupper(Str::substr($jenisAntrian, 0, 1)) }}-0
                            </h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-nowrap">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            {{--  @if ($antrian->jenis_antrian)
                            <h4 class="mb-0">Daftar Antrian Poli {{ strtoupper($antrian[0]->jenis_antrian) }}</h4>
                            @endif --}}
                            @if (!empty($antrian) && count($antrian) > 0)
                                <h4 class="mb-0">Daftar Antrian Poli {{ strtoupper($antrian[0]->jenis_antrian) }}</h4>
                            @else
                                <h4 class="mb-0">Tidak ada antrian</h4>
                            @endif
                        </div>
                        <div>
                            @if ($antrian->contains('status', '!=', 'selesai'))
                            <form action="{{ route('admin-antrian.updateStatus', Request::get('jenis_antrian')) }}"
                                method="post" class="d-inline">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-success">Next Antrian</button>
                            </form>
                            @endif
                            <button type="submit" class="btn btn-primary " data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah Data</button>
                        </div>
                    </div>
                    <div class="card-body text-nowrap">

                        <div class="table-reponsive">
                            {{-- <table id="table" class="table table-striped mt-5" data-toggle="data-table"> --}}
                            <table id="table" class="table table-hover mt-5" style="width: 100%">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Nama Lengkap</th>
                                        <th>No Antrian</th>
                                        <th>Status </th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($antrian as $antrian)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $antrian->user->nama }}</td>
                                            <td>{{ strtoupper(Str::substr($antrian->jenis_antrian, 0, 1)) }}-{{ $antrian->no_antrian }}
                                            </td>
                                            <td>
                                                @if ($antrian->status == 'menunggu')
                                                    <span
                                                        class="badge rounded-pill text-bg-warning">{{ ucfirst($antrian->status) }}</span>
                                                    {{-- <form action="{{ route('admin-antrian.updateStatus', $antrian) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="dipanggil"
                                                            id="">
                                                        <button
                                                            class="btn @if ($antrian->status == 'menunggu') btn-primary @elseif($antrian->status == 'dipanggil') btn-warning @else btn-success @endif">
                                                            {{ ucfirst($antrian->status) }}
                                                        </button>
                                                    </form> --}}
                                                @endif
                                                @if ($antrian->status == 'dipanggil')
                                                    <span
                                                        class="badge rounded-pill text-bg-primary">{{ ucfirst($antrian->status) }}</span>
                                                    {{-- <form action="{{ route('admin-antrian.updateStatus', $antrian) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="selesai" id="">
                                                        <button
                                                            class="btn @if ($antrian->status == 'menunggu') btn-primary @elseif($antrian->status == 'dipanggil') btn-warning @elseif($antrian->status == 'selesai') btn-success @else btn-primary @endif">
                                                            {{ ucfirst($antrian->status) }}
                                                        </button>
                                                    </form> --}}
                                                @endif
                                                @if ($antrian->status == 'selesai')
                                                    <span
                                                        class="badge rounded-pill text-bg-success">{{ ucfirst($antrian->status) }}</span>
                                                    {{-- <form action="{{ route('admin-antrian.updateStatus', $antrian) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button
                                                            class="btn @if ($antrian->status == 'menunggu') btn-primary @elseif($antrian->status == 'dipanggil') btn-warning @elseif($antrian->status == 'selesai') btn-success @else btn-primary @endif"
                                                            disabled>
                                                            {{ ucfirst($antrian->status) }}
                                                        </button>
                                                    </form> --}}
                                                @endif
                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
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
        //     document.addEventListener('DOMContentLoaded', function() {
        //      var userSelect = document.getElementById('user');
        //      var namaInput = document.getElementById('nama');

        //      userSelect.addEventListener('change', function() {
        //          var selectedOption = this.options[this.selectedIndex];
        //          var nama = selectedOption.dataset.nama;

        //          namaInput.value = nama;
        //      });
        //  });

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
    @include('includes.datatables.styles')
@endpush

@push('scripts')
    @include('includes.choices-js.scripts')
    @include('includes.datatables.scripts')

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                sort: false
            });
        });



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
