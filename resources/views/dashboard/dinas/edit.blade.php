@extends('layouts.admin')

@section('main-content')
    <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Dinas</h6>
            </div>

            <div class="card-body">



                <form method="POST" action="{{ route('dinas.store') }}" autocomplete="off">
                    @csrf

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nama dinas<span
                                            class="small text-danger">*</span></label>
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        placeholder="Nama dinas" value="{{ $data->nama }}" readonly>
                                </div>
                            </div>


                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="alamat">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" name="alamat"
                                        placeholder="Alamat" value="{{ $data->alamat }}" readonly>
                                </div>
                            </div>

                        </div>


                        <div class="">
                            <div class="form-group">
                                <label class="form-control-label" for="deskripsi">Deskripsi<span
                                        class="small text-danger">*</span></label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" style="resize: none;" readonly>{{ $data->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="mb-4">
                            <img src="{{ asset('storage/gambar_dinas/' . $data->gambar) }}" alt="Gambar Dinas"
                                style="max-width: 50%; height: auto;">
                        </div>

                        <div class="">
                            <a href="/dinas" class="btn btn-danger">Kembali</a>
                        </div>

                </form>

            </div>
        </div>
    </div>
@endsection
