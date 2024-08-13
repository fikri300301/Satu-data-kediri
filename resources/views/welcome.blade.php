<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kediri satu data</title>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="resource/css/app.css">

    <style>
        .banner {
            background-image: url('{{ asset('storage/banner/bg9.png') }}');
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
                <a class="navbar-brand me-auto" href="/"> <img src="{{ asset('storage/logo/o.png') }}"alt="Logo"
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

    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <h1 class="text-light text-uppercase fw-bolder" style="text-shadow: 3px 3px 5px black;">
                Data Kediri dalam satu portal
            </h1>


            <div class="col-md-8 offset-md-2 mt-4">
                <form action="{{ route('search-welcome-dataset') }}" method="get">
                    <div class="input-group">

                        <input type="text" name="query" placeholder="Cari dataset berdasarkan nama"
                            class="form-control" required>
                        <button class="btn btn-md btn-success" type="submit">Cari</button>

                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- promo -->
    <div class="container-fluid py-5">
        <div class="container">

            <h1 class="text-center mb-4" style="color:rgb(28, 133, 101);text-shadow: 3px 3px 5px rgb(255, 255, 255) ">
                Dataset Terbaru</h1>
            @if (isset($datasets))
                @if ($datasets->isEmpty())
                    <p>Data tidak ditemukan.</p>
                @else
                    @foreach ($datasets as $dataset)
                        <div class="card mb-4">
                            <h5 class="card-header text-light" style="background-color:rgb(28, 133, 101);">
                                {{ $dataset->judul }}</h5>
                            <div class="card-body">
                                <div class="tanggal-nama">
                                    <div class="tanggal">{{ $dataset->updated_at }}</div>
                                    <div class="nama-dinas">
                                        <a style="text-decoration: none;color:black"
                                            href="{{ url('/front-dinas/' . $dataset->dinass->id) }}">{{ $dataset->dinass->nama }}</a>
                                    </div>
                                </div>
                                <p class="card-text">{{ $dataset->deskripsi }}</p>
                                <a href="{{ '/front-dataset/' . $dataset->id }}" class="btn btn-primary">Preview</a>
                            </div>
                        </div>
                    @endforeach

                @endif
            @endif
            <div class="d-flex justify-content-center mt-4">
                <a href="/front-dataset"><button class="btn btn-primary text-light btn-lg">Lihat Semua
                        Dataset</button></a>
            </div>

        </div>
    </div>
    </div>

    <!-- service-->


    <!-- paling banyak dibeli-->
    <div class="container-fluid py-3" style="background-color:rgb(28, 133, 101);">
        <div class="container">
            <footer id="footer" class="footer">
                <div class="row gy-4 mt-1">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="https://data.probolinggokota.go.id/" class="logo d-flex align-items-center">
                            <span style="font-size: 20px;">Kediri Satu Data</span>
                        </a>
                        <p style="color: #ffffff">
                            Portal Satu Data Kediri merupakan portal resmi data terbuka Kediri yang
                            dikelola oleh Sekretariat Satu Data Kediri pada Dinas Komunikasi Dan Informatika
                            krdiri
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
                        <h4 style="color: #ffffff">Contact Us</h4>
                        <p style="color: #ffffff">
                            Dinas Komunikasi Dan Informatika Kota kediri <br>
                            Jl. Dr. Moch Saleh No. 5 <br>
                            kediri Jawa Timur<br>
                            <strong>Phone:</strong> (0335) 422135 <br>
                            <strong>Email:</strong> <a
                                href="mailto:diskominfo@probolinggokota.go.id">diskominfo@kediri.go.id</a><br>
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

</body>

</html>
