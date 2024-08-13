<?php

namespace App\Http\Controllers;

use App\Models\dataset;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $datasets = dataset::where('status', 1)->latest()->take(5)->get();

        return view('welcome', [
            'datasets' => $datasets
        ]);
    }

    public function search(Request $request)
    {
        //query search berdasarkan judul 
        $query = $request->input('query');

        //melakukan pencarian 
        $datasets = dataset::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('judul', 'LIKE', "%{$query}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$query}%");
            })
            ->get();
        return view('welcome', compact('datasets'));
    }
}