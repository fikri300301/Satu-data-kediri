@extends('layouts.admin')

@section('main-content')
    @if ($errors->any())
        <div class="alert alert-danger w-50">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-lg-8 order-lg-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Dinas</h6>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('dinas.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nama dinas<span
                                            class="small text-danger">*</span></label>
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        placeholder="Nama dinas">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="alamat">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" name="alamat"
                                        placeholder="Alamat" value="{{ old('alamat') }}">
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label class="form-control-label" for="deskripsi">Deskripsi<span
                                        class="small text-danger">*</span></label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" style="resize: none;">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control-md form-control"
                                accept="image/*" placeholder="Pilih gambar">
                        </div>




                        <!-- Button -->
                        <div class="pl-lg-4 mt-3">
                            <div class="row">
                                <div class="col">
                                    <a href="/dinas" class="btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
