@extends('layouts.guest')

@section('main-content')
    <div class="container-fluid py-5" style="min-height: 55vh">
        <div class="container">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-4 p-2">
                        <h3 style="color:rgb(28, 133, 101) ">{{ $dataset->judul }}</h3>
                        <div class="tanggal-nama">
                            <div>
                                <small>update :</small>
                            </div>
                            <div class="tanggal">{{ $access_at }}</div>
                            <div class="nama-dinas">
                                <a style="text-decoration: none;color:black"
                                    href="{{ url('/front-dinas/' . $dataset->dinass->id) }}">{{ $dataset->dinass->nama }}</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 p-2">
                    {{ $dataset->deskripsi }}
                </div>


                @if ($endpointTable && $success)
                    <div class="card mt-3">

                        <div class="card-body">
                            <table class="table table-responsive" id="myTable">
                                <thead>
                                    <tr>
                                        @foreach (array_keys($endpointTable[0]) as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($endpointTable as $row)
                                        <tr>
                                            @foreach ($row as $cell)
                                                <td>{{ $cell }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div style="text-align: center; ">
                        <h3> Data belum tersedia</h3>
                    </div>
                @endif
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
                    topstart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        });
    </script>
@endsection
