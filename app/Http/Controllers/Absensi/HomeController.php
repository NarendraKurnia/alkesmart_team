<?php

namespace App\Http\Controllers\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
     public function index(Request $request)
    {
        return view('index', [ 
            'title' => 'Alkesmart Team',
            'user'  => Auth::user(), // kirim data user yang login
        ]);
    }
}
