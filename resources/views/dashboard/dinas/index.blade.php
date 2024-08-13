@extends('layouts.admin')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 500px;">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-start">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                {{-- <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dinas</h6>
                    <a href="/dinas-create" class="btn btn-primary">
                        Tambah Dinas <i class="fas fa-plus"></i>
                    </a>
                </div> --}}
                <div class="card-body">
                    <a href="/dinas-create"><button class="btn btn-primary mb-3">Tambah dinas</button></a>
                    <table id="myTable" class="table table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            @foreach ($data as $dat)
                                <tr>
                                    <td>{{ $a++ }}</td>
                                    <td>{{ $dat->nama }}</td>
                                    <td>{{ $dat->deskripsi }}</td>
                                    <td>{{ $dat->alamat }}</td>
                                    <td>
                                        <a href="/dinas/{{ $dat->id }}/edit" class="btn btn-primary"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="/dinas/{{ $dat->id }}" class="btn btn-success"><i
                                                class="bi bi-eye-fill"></i></a>
                                        <form action="/dinas/{{ $dat->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete user {{ $dat->nama }}?')"><i
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
