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
                            <div class="text-center mb-4">
                                <h1>PUSKESMAS LAMBALE</h1>
                                <img src="{{ asset('assets/img/logo-puskesmas-png-3.png') }}"
                                style="height: 380px;width:280px;border-radius:50%" alt=""
                                class="pict-oval">
                                {{-- gambar --}}

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="card me-0">
                        <div class="card-body">
                            <form action="{{ route('admin-dokter.update', $dokter->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="text-center mb-4">


                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $dokter->nama }}" autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="jataban">Spesialis</label>
                                    <input type="text" class="form-control" id="Spesialis" name="spesialis"
                                        value="{{ $dokter->spesialis }}" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="nama">Email</label>
                                    <input type="email" class="form-control" id="nama" name="email"
                                        value="{{ $dokter->email }}" autocomplete="off" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="mb-0" for="no_hp">No.Hp</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="{{ $dokter->no_hp }}" autocomplete="off" required>
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
