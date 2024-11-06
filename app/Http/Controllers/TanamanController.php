<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Tanaman;
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

    public function perhitunganSAW()
    {
        $tanamans = Tanaman::with(['subkriteria.kriteria'])->get();

        $pengelompokanData = [];
        foreach ($tanamans as $tanaman) {
            foreach ($tanaman->subkriteria as $subkriteria) {
                $pengelompokanData[$subkriteria->kriteria->id][] = [
                    'tanaman' => $tanaman->nama,
                    'subkriteria' => $subkriteria->nama,
                    'skor' => $subkriteria->skor,
                ];
            }
        }

        $nilai_normalisasi = [];
        $skor_akhir = [];
        $total_skor_tanaman = [];

        foreach ($pengelompokanData as $kriteriaId => $subkriterias) {
            // Ambil tipe dan bobot kriteria
            $kriteria = Kriteria::find($kriteriaId);
            $tipe = $kriteria->tipe;
            $bobot = $kriteria->bobot;

            // Tentukan nilai maksimum atau minimum berdasarkan tipe kriteria
            if ($tipe === 'Benefit') {
                $maxValue = max(array_column($subkriterias, 'skor'));
            } else {
                $minValue = min(array_column($subkriterias, 'skor'));
            }

            foreach ($subkriterias as $data) {
                // Hitung nilai normalisasi
                if ($tipe === 'Benefit') {
                    $normalisasi = $data['skor'] / $maxValue;
                } else {
                    $normalisasi = $minValue / $data['skor'];
                }

                // Simpan nilai normalisasi
                $nilai_normalisasi[$kriteriaId][] = [
                    'tanaman' => $data['tanaman'],
                    'subkriteria' => $data['subkriteria'],
                    'nilai_normalisasi' => $normalisasi,
                ];

                // Hitung skor akhir untuk tanaman berdasarkan kriteria
                $skorAkhir = $normalisasi * $bobot;

                // Simpan skor akhir berdasarkan tanaman dan kriteria
                $skor_akhir[$data['tanaman']][$kriteriaId] = $skorAkhir;
            }
        }

        // Hitung total skor tanaman dengan menjumlahkan skor setiap kriteria
        foreach ($skor_akhir as $tanaman => $kriteriaScores) {
            $total_skor_tanaman[$tanaman] = array_sum($kriteriaScores);
        }

        // Mengelompokkan tanaman dengan nama, skor akhir, dan total skor
        $dataPerhitunganAkhir = [];
        foreach ($skor_akhir as $tanaman => $kriteriaScores) {
            $dataPerhitunganAkhir[] = [
                'nama_tanaman' => $tanaman,
                'skor_akhir' => $kriteriaScores,
                'total_skor' => $total_skor_tanaman[$tanaman],
            ];
        }

        return view('content.pages.tanaman.perhitungan-saw', compact('tanamans', 'nilai_normalisasi', 'dataPerhitunganAkhir'));
    }
}
