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
                  <img src="{{ asset('assets/img/logos/logo-puskesmas-png-3.png') }}" width="180" alt="">
                </a>
                <p class="text-center"><b>Selamat   Datang</b></p>
                <form action="{{ route('admin-authenticate') }}" method="POST">
                    @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="d-flex align-items-end justify-content-between mb-3">
                    {{-- <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div> --}}
                
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-3 mt-2 rounded-2">LOGIN</button>
                    <span class="mb-3 align-items-end" style="align-items: left">Belum Punya Akun ? <a class="text-primary fw-bold" href="{{ route('user-register') }}">Register</a></span>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.admin.styling.scripts')
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
</body>

</html>
