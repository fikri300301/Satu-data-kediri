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
                <h6 class="m-0 font-weight-bold text-primary">Tambah Dataset</h6>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('dataset.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nama dataset<span
                                            class="small text-danger">*</span></label>
                                    <input type="text" id="nama" class="form-control" name="judul"
                                        placeholder="Nama dataset">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="dinass_id" class="form-label">Nama dinas</label>
                                <select name="dinass_id" id="dinass_id" class="form-select" value="{{ old('dinass_id') }}">
                                    @foreach ($dinas as $dina)
                                        @if (old('dinass_id') == $dina->id)
                                            <option value="{{ $dina->id }}" selected>{{ $dina->nama }}</option>
                                        @else
                                            <option value="{{ $dina->id }}">{{ $dina->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group mt-3">
                                <label class="form-control-label" for="deskripsi">Deskripsi<span
                                        class="small text-danger">*</span></label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" style="resize: none;"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="endpoint">End Point<span
                                    class="small text-danger">*</span></label>
                            <input type="text" id="endpoint" class="form-control" name="endpoint"
                                placeholder="Link End Point">
                            <button type="button" id="previewButton" class="btn btn-secondary mt-2">Preview</button>
                        </div>

                        <div id="previewContainer" class="mt-4">
                            <h6>Preview Data</h6>
                            <div id="previewTable"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="status">Status<span
                                    class="small text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="publish" value="1"
                                    checked>
                                <label class="form-check-label" for="publish">
                                    Publish
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="draft" value="0">
                                <label class="form-check-label" for="draft">
                                    Draft
                                </label>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4 mt-3">
                            <div class="row">
                                <div class="col">
                                    <a href="/dataset" class="btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('previewButton').addEventListener('click', function() {
            var endpoint = document.getElementById('endpoint').value;

            fetch('{{ route('dataset.preview') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        endpoint: endpoint
                    })
                })
                .then(response => response.json())
                .then(data => {
                    var previewTable = document.getElementById('previewTable');
                    previewTable.innerHTML = '';

                    if (data.error) {
                        previewTable.innerHTML = '<div style="text-align: center;"><h3>' + data.error +
                            '</h3></div>';
                        return;
                    }

                    var table = document.createElement('table');
                    table.classList.add('table', 'table-bordered');

                    var thead = document.createElement('thead');
                    var tr = document.createElement('tr');
                    Object.keys(data.data[0]).forEach(function(key) {
                        var th = document.createElement('th');
                        th.textContent = key;
                        tr.appendChild(th);
                    });
                    thead.appendChild(tr);
                    table.appendChild(thead);

                    var tbody = document.createElement('tbody');
                    data.data.forEach(function(row) {
                        var tr = document.createElement('tr');
                        Object.values(row).forEach(function(value) {
                            var td = document.createElement('td');
                            td.textContent = value;
                            tr.appendChild(td);
                        });
                        tbody.appendChild(tr);
                    });
                    table.appendChild(tbody);

                    previewTable.appendChild(table);

                    if (data.data.length == 5) {
                        previewTable.innerHTML +=
                            '<div style="text-align: center;"><h6>Data di atas hanya merupakan preview dari 5 data pertama.</h6></div>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    previewTable.innerHTML =
                        '<div style="text-align: center;"><h3>Gagal mengambil data dari endpoint</h3></div>';
                });
        });
    </script>
@endsection
