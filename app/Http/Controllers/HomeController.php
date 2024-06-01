<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
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
        return view('home',[
            'murid' => User::where('level',0)->count(),
            'guru' => User::where('level',1)->count(),
            'kelas' => Kelas::count()
        ]);
    }
}
