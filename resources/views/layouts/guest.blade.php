<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />

    {{-- export --}}
    <style>
        .banner {
            background-image: url('{{ asset('storage/banner/poyo.png') }}');
            background-size: cover;
            background-position: center;
            height: 80vh;
        }

        @media (max-width: 768px) {

            /* Media query untuk perangkat dengan lebar layar maksimum 768px (tablet dan ponsel) */
            .banner {
                height: 50vh;
                /* Mengurangi tinggi container agar sesuai dengan ponsel */
            }
        }

        .hovered-card:hover {
            transform: scale(1.1);
            /* Geser card ke atas */
        }

        .hovered-card {
            transition: .4s;
        }

        .tanggal-nama {
            display: flex;
        }

        .tanggal,
        .nama-dinas {
            margin-right: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .nav-item a.nav-link {
            transition: color 0.3s;
            /* Efek transisi warna ketika hover */
        }

        .nav-item a.nav-link:hover {
            color: #ff0000;
            /* Warna teks ketika dihover */
        }

        .nav-item a.nav-link.active {
            font-weight: bold;
            /* Mengubah teks menjadi lebih tebal saat tautan aktif */
        }

        .navbar {
            border-bottom: 1px solid #ccc;
            /* Garis bawah dengan ketebalan 1px dan warna #ccc */
        }

        .navbar {
            margin-bottom: 34px;
            /* Atur jarak bawah navbar sebesar 20px */
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            /* Ubah nilai sesuai keinginan Anda */
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: white">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <a class="navbar-brand me-auto" href="#"> <img src="{{ asset('storage/logo/o.png') }}"alt="Logo"
                        style="max-height: 2.9em; margin-left:10px"></a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }} me-5" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('front-dataset') ? 'active' : '' }} me-5"
                            href="{{ route('front-dataset') }}">Dataset</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('front-dinas') ? 'active' : '' }} me-5"
                            href="{{ route('front-dinas') }}">Dinas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }} me-5"
                            href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('login') ? 'active' : '' }} me-5"
                            href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">

        @yield('main-content')

    </div>

    <!-- paling banyak dibeli-->
    <div class="container-fluid py-3" style="background-color:rgb(29, 139, 106);">
        <div class="container">
            <footer id="footer" class="footer">
                <div class="row gy-4 mt-1">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="https://data.probolinggokota.go.id/" class="logo d-flex align-items-center">
                            <span style="font-size: 20px;color: #ffffff">Kediri Satu Data</span>
                        </a>
                        <p style="color: #ffffff">
                            Portal Satu Data Kota Probolinggo merupakan portal resmi data terbuka Kediri yang
                            dikelola oleh Sekretariat Satu Data Kediripada Dinas Komunikasi Dan Informatika
                            Kediri
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
                        <h4 style="color: #ffffff">Contact Us</h4>
                        <p style="color: #ffffff">
                            Dinas Komunikasi Dan Informatika Kediri <br>
                            Jl. Dr. Moch Saleh No. 5 <br>
                            Kediri Jawa Timur<br>
                            <strong>Phone:</strong> (0335) 422135 <br>
                            <strong>Email:</strong> diskominfo@kediri.go.id<br>
                        </p>
                    </div>
                </div>

                <div class="container mt-4 text-center">
                    <div class="copyright" style="color: #ffffff">
                        &copy; Copyright <strong><span>@2023</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits" style="color: #ffffff">
                        Dinas Komunikasi Dan Informatika Kabupaten Kediri
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script> --}}

    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    @yield('js')
</body>

</html>
