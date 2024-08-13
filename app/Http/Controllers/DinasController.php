<?php

namespace App\Http\Controllers;

use App\Models\dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DinasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dinas = dinas::all();

        return view('dashboard.dinas.index', [
            'data' => $dinas,
        ]);
    }

    public function create()
    {
        return view('dashboard.dinas.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:30|unique:dinass',
                'alamat' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $gambarPath = $file->store('public/gambar_dinas');
                $validatedData['gambar'] = basename($gambarPath);
            }

            Dinas::create($validatedData);

            Session::flash('success', 'success');
            Session::flash('message', 'sukses menambahkan dinas');

            return redirect()->route('dinas.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->getMessageBag();

            return back()->withErrors($errors)->withInput();
        }
    }

    public function show($id)
    {
        $data = dinas::where('id', $id)->first();

        return view('dashboard.dinas.edit', [
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        $data = dinas::where('id', $id)->first();
        $data->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'data dinas berhasil dihapus');

        return redirect()->route('dinas.index')->with('success', 'Dinas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = dinas::where('id', $id)->first();

        return view('dashboard.dinas.update', [
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        try {
            // Validasi data yang diterima dari form
            $validatedData = $request->validate([
                'nama' => 'required|string|max:30|unique:dinass,nama,' . $request->id,
                'alamat' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'gambar' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $gambarPath = $file->store('public/gambar_dinas');
                $validatedData['gambar'] = basename($gambarPath);
            }

            // Cari data dinas berdasarkan ID
            $dinas = Dinas::findOrFail($request->id);

            // Update data dinas
            $dinas->update($validatedData);

            Session::flash('success', 'success');
            Session::flash('message', 'sukses mengupdate dinas' . $dinas->nama);

            // Redirect ke halaman yang tepat atau tampilkan pesan sukses
            return redirect('/dinas');
        } catch (\Throwable $th) {
            $errors = $th->validator->getMessageBag();

            return back()->withErrors($errors)->withInput();
        }
    }
}