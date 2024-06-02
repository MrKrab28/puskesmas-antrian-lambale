@extends('admin.layout')


@section('content')
    <div class="container-fluid content-inner mt-2">
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
                    <button type="submit" class="btn btn-primary " data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Tambah Data</button>
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
                                        <td class="Primary" >


                                            <span class="badge @if($antrian->status == 'menunggu') bg-primary @elseif($antrian->status == 'dipanggil') bg-warning @else bg-success @endif">
                                                {{ ucfirst($antrian->status) }}
                                            </span>
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
