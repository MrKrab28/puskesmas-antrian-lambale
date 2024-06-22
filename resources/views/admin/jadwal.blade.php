@extends('admin.layout')


@section('content')
    <div class="container-fluid content-inner mt-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-nowrap">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="mb-0">Daftar Jadwal Hari ini</h4>
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
                                        <th>Nama Spesialis</th>
                                        <th>Jenis POLI</th>
                                        <th>Tanggal</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($jadwal as $jadwal)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jadwal->dokter->nama }}</td>
                                            <td>{{ strtoupper($jadwal->jenis_antrian) }}</td>
                                            <td>{{ $jadwal->tanggal }}</td>

                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="document.location.href = '{{ route('admin-jadwal.edit', $jadwal->id) }}'">
                                                    <i class="ti ti-pencil"></i>
                                                </button>

                                                <form id="formDelete{{ $jadwal->id }}"
                                                    action="{{ route('admin-jadwal.delete', $jadwal->id) }}"
                                                    class="d-inline" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="">
                                                </form>
                                                <button type="submit" onclick="deleteData({{ $jadwal->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <i class=" ti ti-trash"></i>
                                                </button>

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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin-jadwal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Spesialis</label>

                            <select class="form-select js-choice" name="id_dokter" id="" required>
                                <option value="">pilih</option>
                                @foreach ($daftar_dokter as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Spesialis</label>

                            <select class="form-select js-choice" name="jenis_antrian" id="" required>
                                <option value="">pilih</option>
                                    <option value="gigi" >GIGI</option>
                                    <option value="kia" >KIA</option>
                                    <option value="umum" >UMUM</option>
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="spesialis" class="form-label">spesialis</label>
                            <input type="text" class="form-control" id="spesialis" name="spesialis" autocomplete="off"
                                required>
                        </div> --}}






                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
@push('styles')
    @include('includes.datatables.styles')
    @include('includes.choices-js.styles')
@endpush

@push('scripts')
    @include('includes.datatables.scripts')
    @include('includes.choices-js.scripts')
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

             document.addEventListener('DOMContentLoaded', function() {
             var userSelect = document.getElementById('user');
             var namaInput = document.getElementById('nama');

             userSelect.addEventListener('change', function() {
                 var selectedOption = this.options[this.selectedIndex];
                 var nama = selectedOption.dataset.nama;

                 namaInput.value = nama;
             });
         });
    </script>
@endpush
