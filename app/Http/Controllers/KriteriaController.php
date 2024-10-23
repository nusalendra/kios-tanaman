<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        return view('content.pages.kriteria.index');
    }

    public function kriteria()
    {
        return view('content.pages.kriteria.create');
    }
}
