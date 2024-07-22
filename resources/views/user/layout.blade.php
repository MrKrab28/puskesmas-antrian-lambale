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


    <!-- ======= Header ======= -->
    @include('includes.user.header')
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center mb-5">
        <div class="container">
            <h1>Selamat Datang</h1>
            <h2>Puskesmas Lambale</h2>
            <h6>Desa Lambale Kabupaten Buton Utara</h6>
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        @yield('content')
        {{-- ANTRIAN SECTION --}}
        @include('user.antrian-user')
        {{-- END ANTRIAN SECTION --}}

        <!-- ======= Services Section ======= -->
        @include('user.layanan')
        <!-- End Services Section -->
        <!-- ======= About Section ======= -->
        @include('user.about')
        <!-- End About Section -->
        <!-- ======= Appointment Section ======= -->
        {{-- <section id="appointment" class="appointment section-bg">
            <div class="container">

                <div class="section-title">
                    <h2 style="color: #1977cc">Make an Appointment</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

                <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="tel" class="form-control" name="phone" id="phone"
                                placeholder="Your Phone" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group mt-3">
                            <input type="datetime" name="date" class="form-control datepicker" id="date"
                                placeholder="Appointment Date" data-rule="minlen:4"
                                data-msg="Please enter at least 4 chars">
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="department" id="department" class="form-select">
                                <option value="">Select Department</option>
                                <option value="Department 1">Department 1</option>
                                <option value="Department 2">Department 2</option>
                                <option value="Department 3">Department 3</option>
                            </select>
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="doctor" id="doctor" class="form-select">
                                <option value="">Select Doctor</option>
                                <option value="Doctor 1">Doctor 1</option>
                                <option value="Doctor 2">Doctor 2</option>
                                <option value="Doctor 3">Doctor 3</option>
                            </select>
                            <div class="validate"></div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                        <div class="validate"></div>
                    </div>
                    <div class="mb-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Make an Appointment</button></div>
                </form>

            </div>
        </section><!-- End Appointment Section --> --}}
        <!-- ======= Doctors Section ======= -->


        <!-- ======= Frequently Asked Questions Section ======= -->
        @include('user.faq')
        <!-- End Frequently Asked Questions Section -->

        <!-- ======= Gallery Section ======= -->
        @include('user.gallery')
        <!-- End Gallery Section -->

        <!-- ======= Contact Section ======= -->
        @include('user.contact')
        <!-- End Contact Section -->
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
