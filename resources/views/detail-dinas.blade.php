@extends('layouts.guest')

@section('main-content')
    <!-- promo -->
    <div class="container-fluid py-5">
        <div class="container">

            <div class="card mb-3" style="max-width: 800px;">
                <div class="row g-0">
                    <div class="col-md-4 p-2">
                        <img src="{{ asset('storage/gambar_dinas/' . $dinas['dinass_gambar']) }}" alt="Gambar dinas"
                            class="img-fluid w-100" style="height: auto; max-height: 300px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"
                                style="color:rgb(28, 133, 101);text-shadow: 3px 3px 5px rgb(255, 255, 255) ">
                                {{ $dinas['dinass_nama'] }}</h3>
                            <p><small>Alamat :</small> {{ $dinas['dinass_alamat'] }}</p>
                            <p class="card-text">{{ $dinas['dinass_deskripsi'] }}</p>
                            <p class="card-text"><small
                                    class="text-body-secondary">{{ $dinas['dinass_created_at'] }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="input-group mb-5 mt-5">
                <input type="text" class="form-control" placeholder="Cari data" aria-label="Cari Dinas"
                    aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2">Cari</button>
            </div>

            @foreach ($dinas['datasets'] as $dataset)
                <div class="card mb-4">
                    <h5 class="card-header text-light" style="background-color:rgb(28, 133, 101);">
                        {{ $dataset['dataset_judul'] }}</h5>
                    <div class="card-body">
                        <div class="tanggal-nama">
                            <div class="tanggal">{{ $dataset['dataset_updated_at'] }}</div>
                            {{-- <div class="nama-dinas">{{ $dataset->dinass->nama }}</div> --}}
                        </div>
                        <p class="card-text">{{ $dataset['dataset_deskripsi'] }}</p>
                        <a href="{{ url('/front-dataset/' . $dataset['dataset_id']) }}" class="btn btn-primary">Preview</a>
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
