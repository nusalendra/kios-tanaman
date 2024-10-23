<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index()
    {
        return view('content.pages.tanaman.index');
    }

    public function create()
    {
        return view('content.pages.tanaman.create');
    }
}
