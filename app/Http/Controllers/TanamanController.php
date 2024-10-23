<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    public function index()
    {
        $data = Tanaman::all();
        return view('content.pages.tanaman.index', compact('data'));
    }

    public function create()
    {
        return view('content.pages.tanaman.create');
    }

    public function store(Request $request)
    {
        $tanaman = new Tanaman();
        $tanaman->nama = $request->nama;
        $tanaman->harga = $request->harga;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $tanaman->nama . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar-tanaman', $filename);
            $tanaman->gambar = $filename;
        }

        $tanaman->save();

        return redirect('/tanaman');
    }

    public function edit($id)
    {
        $tanaman = Tanaman::find($id);

        return view('content.pages.tanaman.edit', compact('tanaman'));
    }

    public function update(Request $request, $id)
    {
        $tanaman = Tanaman::find($id);
        $tanaman->nama = $request->nama ?? $tanaman->nama;
        $tanaman->harga = $request->harga ?? $tanaman->harga;

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
