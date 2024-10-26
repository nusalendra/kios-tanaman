<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $data = Subkriteria::all();
        return view('content.pages.subkriteria.index', compact('data'));
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        return view('content.pages.subkriteria.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        foreach ($request->input('nama') as $index => $nama) {
            $subkriteria = new Subkriteria();
            $subkriteria->kriteria_id = $request->input('kriteria_id');
            $subkriteria->nama = $nama;
            $subkriteria->skor = $request->input('skor')[$index];

            $subkriteria->save();
        }

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $subkriteria = Subkriteria::find($id);

        return view('content.pages.subkriteria.edit', compact('subkriteria'));
    }

    public function update(Request $request, $id)
    {
        $subkriteria = Subkriteria::find($id);
        $subkriteria->nama = $request->nama ?? $subkriteria->nama;
        $subkriteria->skor = $request->skor ?? $subkriteria->skor;

        $subkriteria->save();

        return redirect('/subkriteria');
    }

    public function destroy($id)
    {
        $subkriteria = Subkriteria::find($id);
        $subkriteria->delete();

        return redirect('/subkriteria');
    }
}
