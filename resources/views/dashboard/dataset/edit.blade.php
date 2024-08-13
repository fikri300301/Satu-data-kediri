@extends('layouts.admin')

@section('main-content')
    <div class="col-lg-8 order-lg-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Dataset</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('dinas.store') }}" autocomplete="off">
                    @csrf

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nama dataset<span
                                            class="small text-danger">*</span></label>
                                    <input type="text" id="judul" class="form-control" name="judul"
                                        placeholder="Nama dataset" value="{{ $datasets->judul }}" readonly>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="alamat">Nama dinas</label>
                                    <input type="text" id="nama_dinas" class="form-control" name="alamat"
                                        placeholder="Alamat" value="{{ $datasets->dinass->nama }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label class="form-control-label" for="status">Status dataset</label>
                                <input type="text" id="status" class="form-control" name="status"
                                    placeholder="Status" value="{{ $datasets->status == 1 ? 'Publish' : 'Draft' }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label class="form-control-label" for="endpoint">Nama endpoint</label>
                                <input type="text" id="endpoint" class="form-control" name="endpoint"
                                    placeholder="Endpoint" value="{{ $datasets->endpoint }}" readonly>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label class="form-control-label" for="deskripsi">Deskripsi<span
                                        class="small text-danger">*</span></label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" style="resize: none;" readonly>{{ $datasets->deskripsi }}</textarea>
                            </div>
                        </div>

                        <!-- Tabel untuk menampilkan data dari endpoint -->
                        <div class="">
                            <div class="form-group">
                                <label class="form-control-label" for="endpoint_data">Data dari Endpoint</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- Sesuaikan header tabel dengan data yang didapat dari endpoint -->
                                                @if (!empty($endpointData))
                                                    @foreach (array_keys($endpointData[0]) as $header)
                                                        <th>{{ $header }}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($endpointData))
                                                @foreach ($endpointData as $row)
                                                    <tr>
                                                        @foreach ($row as $column)
                                                            <td>{{ $column }}</td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="100%">Tidak ada data dari endpoint</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <a href="/dataset" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
