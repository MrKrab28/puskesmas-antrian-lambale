@extends('admin.layout')


@section('content')



    <div class="container-fluid content-inner mt-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-nowrap">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="mb-0">Daftar user</h4>
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
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No. HP</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $user)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->alamat }}</td>
                                            @if ($user->jk == 'L')
                                                <td>Laki - Laki</td>
                                            @elseif ($user->jk == 'P')
                                                <td>Perempuan</td>
                                            @endif

                                            <td>{{ $user->no_hp }}</td>

                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="document.location.href = '{{ route('user-edit', $user->id) }}'">
                                                    <i class="ti ti-pencil"></i>
                                                </button>

                                                <form id="formDelete{{ $user->id }}"
                                                    action="{{ route('user-delete', $user->id) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="">
                                                </form>
                                                    <button type="submit" onclick="deleteData({{ $user->id }})"
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK KTP</label>
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="input-group-text" id="basic-addon1">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" value="L" id="jk">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jk" value="P"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="jk">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" autocomplete="off"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label" id="Password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
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
@endpush

@push('scripts')
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




