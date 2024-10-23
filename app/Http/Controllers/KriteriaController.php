<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $data = Kriteria::all();
        return view('content.pages.kriteria.index', compact('data'));
    }

    public function create()
    {
        $tanaman = Tanaman::all();
        return view('content.pages.kriteria.create', compact('tanaman'));
    }

    public function store(Request $request)
    {
        foreach ($request->input('nama') as $index => $nama) {
            $kriteria = new Kriteria();
            $kriteria->tanaman_id = $request->input('tanaman_id');
            $kriteria->nama = $nama;
            $kriteria->tipe = $request->input('tipe')[$index];
            $kriteria->bobot = $request->input('bobot')[$index];

            $kriteria->save();
        }

        return redirect('/kriteria');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::find($id);

        return view('content.pages.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->nama = $request->nama ?? $kriteria->nama;
        $kriteria->tipe = $request->tipe ?? $kriteria->tipe;
        $kriteria->bobot = $request->bobot ?? $kriteria->bobot;

        $kriteria->save();

        return redirect(('/kriteria'));
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();

        return redirect('/kriteria');
    }
}
