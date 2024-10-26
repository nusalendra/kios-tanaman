<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Tanaman;
use App\Models\TanamanSubkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    public function index()
    {
        $data = Tanaman::with('subkriteria')->get();
        $kriteria = Kriteria::with('subkriteria')->get();

        return view('content.pages.tanaman.index', compact('data', 'kriteria'));
    }

    public function create()
    {
        $kriteria = Kriteria::with('subkriteria')->get();
        return view('content.pages.tanaman.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $tanaman = new Tanaman();
        $tanaman->nama = $request->nama;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $tanaman->nama . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar-tanaman', $filename);
            $tanaman->gambar = $filename;
        }

        $tanaman->save();

        if ($request->has('subkriteria_id')) {
            $tanaman->subkriteria()->attach($request->subkriteria_id);
        }

        return redirect('/tanaman');
    }

    public function edit($id)
    {
        $tanaman = Tanaman::find($id);
        $kriteria = Kriteria::with('subkriteria')->get();
        $selectedSubkriteria = $tanaman->subkriteria->pluck('id')->toArray();

        return view('content.pages.tanaman.edit', compact('tanaman', 'kriteria', 'selectedSubkriteria'));
    }

    public function update(Request $request, $id)
    {
        $tanaman = Tanaman::find($id);
        $tanaman->nama = $request->nama ?? $tanaman->nama;

        if ($request->hasfile('gambar')) {
            if ($tanaman->gambar) {
                Storage::delete('public/gambar-tanaman/' . $tanaman->gambar);
            }

            $file = $request->file('gambar');
            $filename = $tanaman->nama . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar-tanaman', $filename);
            $tanaman->gambar = $filename;
        }

        $tanaman->save();

        if ($request->has('subkriteria_id')) {
            $tanaman->subkriteria()->sync($request->subkriteria_id);
        }

        return redirect('/tanaman');
    }

    public function destroy($id)
    {
        $tanaman = Tanaman::find($id);
        Storage::delete('public/gambar-tanaman/' . $tanaman->gambar);
        $tanaman->delete();

        return redirect('/tanaman');
    }
}
