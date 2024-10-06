<style>

    /* Styling untuk dropdown */
    @media (max-width: 768px) {
    .dropdown > ul {
        display: none;
    }
    .dropdown > ul.show {
        display: block;
    }
}
</style>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="index.html" style="color: #1977cc">Puskemas Lambale</a></h1>


        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                {{-- <li class="dropdown"><span class="ri-user-line">{{ auth()->user()->nama }}</span>
                    <i class="bi bi-chevron-down"></i>
                    <ul>
                        <li><a href="{{ route('profile', auth()->user()->id) }}"><span class="ri-account-circle-line">
                                    PROFILE</span></a></li>
                        <li><button onclick="document.location.href='{{ route('user-logout') }}' " type="button"
                                class="btn btn-outline-primary mx-3 mt-2 d-block"><i
                                    class=" ti ti-logout"></i>Logout</button></li>
                    </ul>
                </li> --}}
                <li class="dropdown">
                    <span class="dropdown-toggle">{{ auth()->user()->nama }} </span>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profile', auth()->user()->id) }}"><span class="ri-account-circle-line">
                            Profile</span></a></li>
                        <li><button onclick="document.location.href='{{ route('user-logout') }}' " type="button"
                            class="btn btn-outline-primary mx-3 mt-2 d-block"><i
                                class=" ti ti-logout"></i>Logout</button></li>
                    </ul>
                </li>
            </ul>

            <i class="bi bi-list mobile-nav-toggle">

            </i>
        </nav><!-- .navbar -->


        {{-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Daftar</span>
            Berobat</a> --}}


    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        dropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle')) {
                const dropdowns = document.getElementsByClassName('dropdown-menu');
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        });
    });
</script>
