<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function master()
    {
        return view('admin.layouts.master', [
            'currentPage' => 'Dashboard',
            'titulo' => 'Tablero de Control',
            'showPanel' => true,  // Variable para controlar la inclusión
        ]);
    }
}
