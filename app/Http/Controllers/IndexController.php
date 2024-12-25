<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $tanaman = Tanaman::with(['subkriteria.kriteria'])->get();

        return view('content.pages.guest.index', compact('tanaman'));
    }

    public function fetchAllDataTanaman()
    {
        $tanaman = Tanaman::with('subkriteria.kriteria')->get();
        return response()->json($tanaman);
    }

    public function perhitunganSAW()
    {
        // Mengambil data tanaman dengan subkriteria dan kriteria
        $tanamans = Tanaman::with(['subkriteria.kriteria'])->get();

        // Mengelompokkan data berdasarkan kriteria.id
        $pengelompokanData = $tanamans->flatMap(function ($tanaman) {
            return $tanaman->subkriteria->map(function ($subkriteria) use ($tanaman) {
                return [
                    'tanaman' => $tanaman->nama,
                    'subkriteria' => $subkriteria->nama,
                    'skor' => $subkriteria->skor,
                    'kriteria_id' => $subkriteria->kriteria->id,
                ];
            });
        })->groupBy('kriteria_id');

        $nilai_normalisasi = [];
        $skor_akhir = [];
        $total_skor_tanaman = [];

        // Normalisasi dan skor akhir per kriteria
        $pengelompokanData->each(function ($subkriterias, $kriteriaId) use (&$nilai_normalisasi, &$skor_akhir, &$total_skor_tanaman) {
            $kriteria = Kriteria::find($kriteriaId);
            $tipe = $kriteria->tipe;
            $bobot = $kriteria->bobot;

            // Tentukan max/min skor berdasarkan tipe kriteria
            $extremeValue = ($tipe === 'Benefit')
                ? $subkriterias->max('skor')
                : $subkriterias->min('skor');

            // Iterasi dan hitung normalisasi serta skor akhir
            $subkriterias->each(function ($data) use ($tipe, $extremeValue, $bobot, $kriteriaId, &$nilai_normalisasi, &$skor_akhir) {
                // Normalisasi
                $normalisasi = ($tipe === 'Benefit')
                    ? $data['skor'] / $extremeValue
                    : $extremeValue / $data['skor'];

                // Menyimpan nilai normalisasi
                $nilai_normalisasi[$kriteriaId][] = [
                    'tanaman' => $data['tanaman'],
                    'subkriteria' => $data['subkriteria'],
                    'nilai_normalisasi' => $normalisasi,
                ];

                // Hitung skor akhir
                $skorAkhir = $normalisasi * $bobot;
                $skor_akhir[$data['tanaman']][$kriteriaId] = $skorAkhir;
            });
        });

        // Hitung total skor untuk setiap tanaman
        $total_skor_tanaman = collect($skor_akhir)->mapWithKeys(function ($kriteriaScores, $tanaman) {
            // Pastikan $kriteriaScores adalah koleksi
            $kriteriaScores = collect($kriteriaScores);
            return [$tanaman => $kriteriaScores->sum()];
        });

        // Menyusun data akhir
        $dataPerhitunganAkhir = collect($skor_akhir)->map(function ($kriteriaScores, $tanaman) use ($total_skor_tanaman, $tanamans) {
            $tanamanData = $tanamans->firstWhere('nama', $tanaman);

            // Ambil subkriteria dan kriteria
            $kriteriaDanSubkriteria = $tanamanData->subkriteria->map(function ($subkriteria) {
                return [
                    'nama_kriteria' => $subkriteria->kriteria->nama,
                    'nama_subkriteria' => $subkriteria->nama,
                ];
            });

            return [
                'nama_tanaman' => $tanaman,
                'deskripsi' => $tanamanData->deskripsi,
                'skor_akhir' => $kriteriaScores,
                'total_skor' => $total_skor_tanaman[$tanaman],
                'kriteria' => $kriteriaDanSubkriteria, // Tambahkan kriteria dan subkriteria
            ];
        });

        // Ambil gambar tanaman sebelum dikirim ke view
        $dataPerhitunganAkhir = $dataPerhitunganAkhir->map(function ($data) use ($tanamans) {
            // Temukan tanaman yang sesuai dengan nama
            $tanaman = $tanamans->firstWhere('nama', $data['nama_tanaman']);

            // Jika ditemukan dan gambar valid, tetapkan gambar
            if ($tanaman && !empty($tanaman->gambar)) {
                $data['gambar'] = $tanaman->gambar;
            } else {
                $data['gambar'] = 'default.jpg';
            }

            return $data;
        });

        // Sorting data berdasarkan total_skor (dalam urutan menurun)
        $dataPerhitunganAkhir = $dataPerhitunganAkhir->sortByDesc('total_skor');

        return view('content.pages.guest.filtered-tanaman-rekomendasi', compact('dataPerhitunganAkhir'))->render();
    }
}
