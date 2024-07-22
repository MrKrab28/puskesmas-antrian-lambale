@extends('admin.layout')

@section('content')
    {{-- <div class="row">
            <div class="col-6"></div>
        </div> --}}
    <div class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="card me-0">
                        <div class="card-body">
                            <form action="{{ route('admin-profile.update', auth()->user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                {{-- <div class="text-center mb-4">
                                    <img src="{{ asset('f/foto-profile/' . $user->foto_profile) }}"
                                        style="height: 150px;width:150px;border-radius:50%" alt=""
                                        class="pict-oval">
                                </div> --}}
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ auth()->user()->nama }}" autocomplete="off">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="mb-0" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{auth()->user()->email }}" autocomplete="off" required>
                                </div>


                                <div class="form-group mb-3">
                                    <label class="mb-0" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" value=""
                                        name="password">
                                    <small id="passHelp" class="form-text text-muted">Kosongkan jika tidak ingin mengganti
                                        password</small>
                                </div>
                        </div>
                        <div class="card-footer text-right pb-4 mt-0">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .pict-oval {
            object-fit: cover;
        }
    </style>
@endpush
@if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
