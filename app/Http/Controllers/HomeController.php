<?php

namespace App\Http\Controllers;

use App\Models\dataset;
use App\Models\dinas;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $dataset = dataset::count();
        $dinas = dinas::count();

        $widget = [
            'users' => $users,
            'dataset' => $dataset,
            'dinas' => $dinas
            //...
        ];

        return view('home', compact('widget'));
    }
}
