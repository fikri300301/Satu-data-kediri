<?php

namespace App\Http\Controllers;

use App\Models\dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class FrontDatasetController extends Controller
{
    public function index()
    {
        $datasets = dataset::where('status', 1)->get();
        return view('dataset', [
            'datasets' => $datasets,
            'title' => 'SATU DATA | Dataset',
        ]);
    }

    public function search(Request $request)
    {
        //query search berdasarkan judul 
        $query = $request->input('query');
        $title = "SATU DATA | Pencarian Dataset";
        //melakukan pencarian 
        $datasets = dataset::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('judul', 'LIKE', "%{$query}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$query}%");
            })
            ->get();

        return view('dataset', compact('datasets'));
    }

    public function detail($id)
    {
        try {
            $dataset = Dataset::find($id);

            // Ensure dataset is found
            if (!$dataset) {
                return redirect()->back()->with('error', 'Dataset tidak ditemukan');
            }

            $endpoint = $dataset->endpoint;

            // Validasi URL
            if (filter_var($endpoint, FILTER_VALIDATE_URL) === FALSE) {
                echo "<script>alert('Data belum ada')</script>";
                echo "<script>window.location = '/'</script>";
            }

            $response = Http::get($endpoint);

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Dataset tidak ditemukan');
            }

            if ($response->successful()) {
                $endpointTable = $response->json();
                if (!is_array($endpointTable) || empty($endpointTable) || !is_array($endpointTable[0])) {
                    throw new \Exception('Invalid data format');
                }
            }


            return view('detail-dataset', [
                'dataset' => $dataset,
                'title' => 'SATU DATA | Dataset Detail',
                'endpointTable' => $endpointTable,
                'success' => true,
                'access_at' => Date::now()

            ]);
            //code...
        } catch (\Throwable $th) {
            return view('detail-dataset', [
                'dataset' => $dataset,
                'endpointTable' => 'data tidak ditemukan',
                'success' => false,
                'access_at' => Date::now()
            ]);
            dd($th);
            throw $th;
        }
    }
}
