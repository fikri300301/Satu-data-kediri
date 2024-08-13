@extends('layouts.guest')

@section('main-content')
    <!-- promo -->
    <div class="container-fluid py-5">
        <div class="container">
            <h1 class="text-center mb-4 text-uppercase fw-bolder"
                style="color:rgb(29, 139, 106);text-shadow: 3px 3px 5px rgb(255, 255, 255)">Pencarian
                Dinas</h1>
            <p class="text-center">
                Dinas digunakan untuk mengkelompokkan dataset berdasarkan kelompok dataset dinas tersebut
            </p>
            <form action="{{ route('search-front-dinas') }}" method="get">
                <div class="input-group mb-5 mt-5">
                    <div class="input-group">
                        <input type="text" name="query" placeholder="Cari dinas berdasarkan nama" class="form-control"
                            required value="{{ request('query') }}">
                        <button class="btn btn-md btn-success" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <div class="row justify-content-center">

                @foreach ($dinas as $din)
                    <div class="col-sm-6 col-lg-3 mb-4 hovered-card">
                        <div class="card">
                            <div class="card-header bg-white">
                                <img src="{{ asset('storage/gambar_dinas/' . $din->gambar) }}" class="card-img-top"
                                    alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-title"><a href="/front-dinas/{{ $din->id }}"
                                        style="text-decoration: none;">{{ $din->nama }}</a></p>

                                @foreach ($datasets as $dataset)
                                    @if ($dataset->id === $din->id)
                                        <h5 class="card-title" style="color:rgb(29, 139, 106)">
                                            {{ $dataset->jumlah_dataset }} Dataset</h5>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ini nanti diganti pagination --}}
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-primary text-light btn-lg">Lihat Semua Dataset</button>
            </div>

        </div>
    </div>
    </div>
@endsection
