<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Puskesmas Lambale</title>
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/logos/favicon.png') }}" /> --}}
    @include('includes.admin.styling.styles')
    @stack('modals')
    @stack('styles')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        let pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        console.log(pusher)
    </script>
</head>

<body>
    <div class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/lambale33.jpg') }}" style="height: 600px;width:780px" alt="">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="card me-0">
                        <div class="card-body">
                            <form action="{{ route('profile-update', $user->id) }}" method="POST"
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
                                        value="{{ $user->nama }}" autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="nik">NIK KTP</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        autocomplete="off" value="{{ $user->nik }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="{{ $user->alamat }}" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" autocomplete="off" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="input-group-text" id="basic-addon1">Jenis Kelamin</label>
                                    <div class="form-check form-check-inline ms-3">
                                        <input class="form-check-input" id="inlineRadio1"type="radio" name="jk"
                                            value="P" {{ $user->jk == 'P' ? 'checked' : '' }}>
                                        <label for="inlineRadio1"> Perempuan</label>
                                    </div>
                                    <div class="form-check form-check-inline ms-5">
                                        <input class="form-check-input" id="inlineRadio2"type="radio" name="jk"
                                            value="L" {{ $user->jk == 'L' ? 'checked' : '' }}>
                                        <label for="inlineRadio2"> Laki - Laki</label>
                                    </div>


                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-0" for="no_hp">No.Hp</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="{{ $user->no_hp }}" autocomplete="off" required>
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
                            <button type="submit" class="btn btn-success text-dark">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('includes.admin.styling.scripts')
    @stack('modals')
    @stack('scripts')
    @if (Session::has('login-success'))
        <script>
            Swal.fire({
                title: "{{ Session::get('login-success') }}",
                text: "Selamat Datang",
                icon: "success"
            });
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: "Gagal",
                text: "{{ Session::get('error') }}",
                icon: "error"
            });
        </script>
    @endif
</html>
    {{-- <div class="row">
            <div class="col-6"></div>
        </div> --}}


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
