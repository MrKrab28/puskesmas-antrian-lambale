<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puskesmas Lambale</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logos/logo-puskesmas-png-3.png') }}" />
    @include('includes.admin.styling.styles')

</head>

<body class="bg-primary">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-0 w-100">
                                    <img src="{{ asset('assets/img/logos/logo-puskesmas-png-3.png') }}" width="180"
                                        alt="">
                                </a>
                                <p class="text-center"><b>Daftar Akun</b></p>
                                <form action="{{ route('user-register.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="nama" class="form-label">Nama Lengap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="nik" class="form-label">NIK KTP</label>
                                        <input type="text"  maxlength="16" minlength="16" class="form-control" id="nik" name="nik"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            name="email" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-2">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="" class="input-group-text" id="basic-addon1">Jenis
                                            Kelamin</label>
                                        <div class="form-check form-check-inline ms-3">
                                            <input class="form-check-input" id="inlineRadio1"type="radio" name="jk"
                                                value="P">
                                            <label for="inlineRadio1"> Perempuan</label>
                                        </div>
                                        <div class="form-check form-check-inline ms-5">
                                            <input class="form-check-input" id="inlineRadio2"type="radio" name="jk"
                                                value="L">
                                            <label for="inlineRadio2"> Laki - Laki</label>
                                        </div>


                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-2">
                                        <label for="no_hp" class="form-label">No. HP</label>
                                        <input name="no_hp" type="text" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">


                                        <button type="submit"
                                            class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2">REGISTER</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
