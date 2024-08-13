@extends('layouts.guest')

@section('main-content')
    <!-- promo -->
    <div class="container-fluid py-5">
        <div class="container">
            <h1 class="text-center mb-4">Pencarian Dataset</h1>

            <p class="text-center">Layanan informasi dan fitur satu data untuk meningkatkan efektifitas pengambilan
                kebijakan dengan
                berdasarkan data yang dapat dilihat oleh seluruh masyarakat, bersumber dari organisasi Kabupaten Kediri.
            </p>
            <form action="{{ route('search-front-dataset') }}" method="get">
                <div class="input-group mb-5 mt-5">
                    <div class="input-group">
                        <input type="text" name="query" placeholder="Cari dataset berdasarkan nama" class="form-control"
                            required>
                        <button class="btn btn-md btn-success" type="submit">Cari</button>
                    </div>
                </div>
            </form>
            @foreach ($datasets as $dataset)
                <div class="card mb-4">
                    <h5 class="card-header text-light" style="background-color: rgb(29, 139, 106)">
                        {{ $dataset->judul }}
                    </h5>
                    <div class="card-body">
                        <div class="tanggal-nama">
                            <div class="tanggal">{{ $dataset->updated_at }}</div>
                            <div class="nama-dinas">
                                <a href="{{ url('/front-dinas/' . $dataset->dinass->id) }}"
                                    style="text-decoration: none;color:black">
                                    {{ $dataset->dinass->nama }}</a>
                            </div>
                        </div>
                        <p class="card-text">{{ $dataset->deskripsi }}
                        </p>
                        <a href="{{ url('/front-dataset/' . $dataset->id) }}" class="btn btn-primary">Preview</a>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-primary text-light btn-lg">Lihat Semua Dataset</button>
            </div>

        </div>
    </div>
    </div>
@endsection
