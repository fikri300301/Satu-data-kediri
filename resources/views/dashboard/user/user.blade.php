@extends('layouts.admin')

@section('main-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a = 1; ?>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $a++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ 'admin' }}</td>
                                <td><a href="/user/{{ $user->slug }}/edit"><button class="btn btn-primary"><i
                                                class="bi bi-pencil-square"></i></button></a>

                                    <form action="user/{{ $user->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf

                                        <button class="btn btn-danger"
                                            onclick="return confirm ('are you sure to delete user {{ $user->name }}?')"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
