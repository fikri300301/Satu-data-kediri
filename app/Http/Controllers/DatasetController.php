<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\dinas;
use App\Models\dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DatasetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datasets = dataset::all();

        return view('dashboard.dataset.index', [
            'datasets' => $datasets,
        ]);
    }

    public function create()
    {
        $dinas = dinas::all();
        $authors = User::all();

        return view('dashboard.dataset.create', [
            'dinas' => $dinas,
            'authors' => $authors
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255|unique:datasets',
            'deskripsi' => 'required',
            'dinass_id' => 'required',
            'status' => 'required',
            'endpoint' => 'required',
        ]);

        $user_id = auth()->id();

        $validatedData['user_id'] = $user_id;


        dataset::create($validatedData);
        Session::flash('success', 'success');
        Session::flash('message', 'sukses menambahkan dataset');

        return redirect()->route('dataset.index');
    }

    public function previewEndpoint(Request $request)
    {
        $endpoint = $request->input('endpoint');

        // Validasi URL
        if (filter_var($endpoint, FILTER_VALIDATE_URL) === FALSE) {
            return response()->json(['error' => 'Invalid URL'], 400);
        }

        $response = Http::get($endpoint);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from endpoint'], 500);
        }

        $endpointTable = $response->json();

        if (!is_array($endpointTable) || empty($endpointTable) || !is_array($endpointTable[0])) {
            return response()->json(['error' => 'Invalid data format'], 500);
        }

        $endpointTable = array_slice($endpointTable, 0, 5);

        return response()->json(['data' => $endpointTable], 200);
    }

    public function show($id)
    {
        $datasets = dataset::where('id', $id)->first();

        // Eksekusi endpoint untuk mendapatkan data
        $endpointData = [];
        if ($datasets && $datasets->endpoint) {
            $response = Http::get($datasets->endpoint);
            if ($response->successful()) {
                $data = $response->json();

                $endpointData = array_slice($data, 0, 5);
            }
        }
        return view('dashboard.dataset.edit', [
            'datasets' => $datasets,
            'endpointData' => $endpointData
        ]);
    }

    public function edit($id)
    {
        $datasets = dataset::where('id', $id)->first();
        $dinas = dinas::all();

        return view('dashboard.dataset.update', [
            'datasets' => $datasets,
            'dinas' => $dinas
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|max:255|unique:datasets,judul,' . $id,
                'deskripsi' => 'required',
                'dinass_id' => 'required',
                'status' => 'required',
                'endpoint' => 'required',
            ]);

            $dataset = dataset::findOrFail($id);

            $dataset->update($validatedData);


            Session::flash('success', 'success');
            Session::flash('message', 'sukses mengupdate data' . $dataset->judul);

            return redirect('/dataset')->with('success', 'Dataset berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => $th->getMessage()])->withInput();
        }
    }


    public function destroy($id)
    {
        $datasets = dataset::where('id', $id)->first();
        $datasets->delete();

        Session::flash('success', 'success');
        Session::flash('message', 'sukses menghapus data ' . $datasets->judul);

        return redirect('/dataset');
    }
}
