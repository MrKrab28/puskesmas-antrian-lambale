<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logos/favicon.png') }}" />
    @include('includes.admin.styling.styles')
    @stack('modals')
    @stack('styles')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <aside class="left-sidebar">
            @include('includes.admin.sidebar')
        </aside>


        <!--  Main wrapper -->
        <div class="body-wrapper">
        
            <!--  Header Start -->
            @include('includes.admin.header')
            <!--  Header End -->



            <div class="container-fluid">
                <!--  Row 1 -->
                @yield('content')

            </div>
        </div>
    </div>
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
</body>

</html>
