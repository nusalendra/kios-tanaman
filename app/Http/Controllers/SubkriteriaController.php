<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function index()
    {
        return view('content.pages.subkriteria.index');
    }

    public function create()
    {
        return view('content.pages.subkriteria.create');
    }
}
