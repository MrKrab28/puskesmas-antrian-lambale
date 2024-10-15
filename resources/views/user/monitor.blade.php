<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Puskesmas Lambale</title>


    <!-- Favicons -->
    @include('includes.styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

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
    <main id="main">
        <section id="counts" class="counts">
            <div class="container">
                <div class="section-title">
                    <h2 style="color: #1977cc">Antrian Layanan</h2>
                    <p>Antrian Layanan Puskesmas Lambale: Konsultasi dokter, perawatan gigi, imunisasi, dukungan
                        persalinan, serta
                        layanan kesehatan lainnya. Sistem antrian efisien untuk menjamin pelayanan yang ramah dan
                        berkualitas.
                    </p>
                </div>

                @php
                    $jenisAntrian = ['kia', 'umum', 'gigi'];
                @endphp

                @livewire('data-antrian-layanan', ['jenisAntrian' => $jenisAntrian])
                <div class="row">
                    <div class="col-md-4 justify-content-center d-flex align-items-center">
                        <img src="{{ asset('assets/img/logos/logo-puskesmas-png-3.png') }}" width="200" alt="" />
                    </div>
                    <div class="col-md-4  d-flex align-items-center ">

                        <h1 class="logo me-auto "><a href="index.html"  style="color: #1977cc;font-weight: 700">Puskemas Lambale</a></h1>
                    </div>
                    <div class="col-md-4 justify-content-center d-flex align-items-center">
                        <img src="{{ asset('assets/img/logos/logo-puskesmas-png-3.png') }}" width="200" alt="" />

                    </div>
                </div>
            </div>

        </section>


        @push('styles')
            @include('includes.styles')
        @endpush

        @push('scripts')
            @include('includes.choices-js.scripts')
            @include('includes.scripts')
            <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
            <script>
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
            @if (Session::has('info'))
                <script>
                    Swal.fire({
                        title: "Berhasil",
                        text: "{{ Session::get('info') }}",
                        icon: "info"
                    });
                </script>
            @endif
        @endpush
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    @include('includes.scripts')
    @yield('scripts')
    @if (Session::has('profile-edit'))
        <script>
            Swal.fire({
                title: "{{ Session::get('profile-edit') }}",

                icon: "success"
            });
        </script>
    @endif
</body>

</html>
