<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PriviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchData(Request $request)
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

        return response()->json(['data' => $endpointTable], 200);
    }
}
