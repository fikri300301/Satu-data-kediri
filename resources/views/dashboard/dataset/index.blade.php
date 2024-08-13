@extends('layouts.admin')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success" style="width:500px;">
            {{ session('message') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data dataset</h6>
                </div>
                <div class="card-body">
                    <a href="/dataset-create" class="btn btn-primary mb-3">Tambah dataset</a>
                    <div class="table-responsive">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dataset</th>
                                    <th>Deskripsi</th>
                                    <th>Dinas</th>
                                    <th>End-point</th>
                                    <th>Penulis</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1; ?>
                                @foreach ($datasets as $data)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>{{ $data->dinass->nama }}</td>
                                        <td>{{ $data->endpoint }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>
                                            @if ($data->status == 1)
                                                Publish
                                            @else
                                                Draft
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/dataset/{{ $data->id }}/edit" class="btn btn-primary"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="/dataset/{{ $data->id }}" class="btn btn-success"><i
                                                    class="bi bi-eye-fill"></i></a>
                                            <form action="dataset/{{ $data->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger"
                                                    onclick="return confirm ('Are you sure to delete user {{ $data->judul }}?')"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                layout: {
                    bottomStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        });
    </script>
@endsection
