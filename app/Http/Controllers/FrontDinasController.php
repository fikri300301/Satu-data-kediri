<?php

namespace App\Http\Controllers;

use App\Models\dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontDinasController extends Controller
{
    public function index()
    {
        $dinas = dinas::all();
        $datasets = DB::table('dinass')
            ->select('dinass.id', 'dinass.nama', DB::raw('COUNT(datasets.id) AS jumlah_dataset'))
            ->leftJoin('datasets', 'dinass.id', '=', 'datasets.dinass_id')
            ->groupBy('dinass.id', 'dinass.nama')
            ->get();
        return view('dinas', [
            'dinas' => $dinas,
            'datasets' => $datasets,
            'title' => 'SATU DATA|Dinas'
        ]);
    }

    public function search(Request $request)
    {
        //query search berdasarkan nama
        $query = $request->input('query');
        $title = 'SATU DATA|Pencarian Dinas';
        //melakukan pencarian
        $dinas = dinas::where('nama', 'LIKE', "%{$query}%")
            ->get();

        $datasets = DB::table('dinass')
            ->select('dinass.id', 'dinass.nama', DB::raw('COUNT(datasets.id) AS jumlah_dataset'))
            ->leftJoin('datasets', 'dinass.id', '=', 'datasets.dinass_id')
            ->groupBy('dinass.id', 'dinass.nama')
            ->get();

        return view('dinas', compact('dinas', 'datasets', 'query', 'title'));
    }
    public function detail($id)
    {
        $dinas = Dinas::with(['datasets' => function ($query) {
            $query->select('id', 'judul', 'deskripsi', 'updated_at', 'dinass_id'); // pilih kolom yang diperlukan
        }])->find($id);

        // Memastikan dinas ditemukan
        if (!$dinas) {
            return redirect()->back()->with('error', 'Dinas tidak ditemukan');
        }

        // Mengubah hasil ke bentuk yang sesuai dengan format query SQL yang diberikan
        $result = [
            'dinass_id' => $dinas->id,
            'dinass_nama' => $dinas->nama,
            'dinass_deskripsi' => $dinas->deskripsi,
            'dinass_alamat' => $dinas->alamat,
            'dinass_created_at' => $dinas->created_at->format('d-m-Y'),
            'dinass_gambar' => $dinas->gambar,
            'datasets' => $dinas->datasets->map(function ($dataset) {
                return [
                    'dataset_id' => $dataset->id,
                    'dataset_judul' => $dataset->judul,
                    'dataset_deskripsi' => $dataset->deskripsi,
                    'dataset_updated_at' => $dataset->updated_at,
                ];
            }),
        ];

        return view('detail-dinas', [
            'dinas' => $result,
            'title' => 'SATU DATA|Dinas Detail'
        ]);
    }
}
