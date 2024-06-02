@extends('layout')

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
                                <img src="{{ asset('f/foto-ktp/' . $pegawai->foto_ktp) }}"
                                    style="height: 150px;width:150px;border-radius:50%" alt=""
                                    class="pict-oval">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="card me-0">
                        <div class="card-body">
                            <form action="{{ route('pegawai-update', $pegawai->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="text-center mb-4">
                                    <img src="{{ asset('f/foto-profile/' . $pegawai->foto_profile) }}"
                                        style="height: 150px;width:150px;border-radius:50%" alt=""
                                        class="pict-oval">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $pegawai->nama }}" autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="jataban">Jabatan</label>
                                    <input type="text" class="form-control" id="nama" name="jabatan"
                                        value="{{ $pegawai->jabatan }}" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="nama">Email</label>
                                    <input type="email" class="form-control" id="nama" name="email"
                                        value="{{ $pegawai->email }}" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="input-group-text" id="basic-addon1">Jenis Kelamin</label>
                                    <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" id="inlineRadio1"type="radio" name="jk"
                                            value="P" {{ $pegawai->jk == 'P' ? 'checked' : '' }}>
                                        <label for="inlineRadio1"> Perempuan</label>
                                    </div>
                                    <div class="form-check form-check-inline ms-5">
                                        <input class="form-check-input" id="inlineRadio2"type="radio" name="jk"
                                            value="L" {{ $pegawai->jk == 'L' ? 'checked' : '' }}>
                                        <label for="inlineRadio2"> Laki - Laki</label>
                                    </div>


                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="no_hp">No.Hp</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="{{ $pegawai->no_hp }}" autocomplete="off" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="no_hp">Ganti Foto KTP</label>
                                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp"
                                        autocomplete="off">
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
