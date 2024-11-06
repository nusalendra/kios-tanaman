@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Tanaman')

@section('content')
    <div class="card p-3">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive text-nowrap p-0">
                <div class="card">
                    <h5 class="card-header text-dark fw-bold">Mengubah Subkriteria Menjadi Skor</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <tr class="text-center">
                                    <th class="fw-bold">Alternatif</th>
                                    @php
                                        $kriteria = [];
                                        foreach ($tanamans as $tanaman) {
                                            foreach ($tanaman->subkriteria as $sub) {
                                                $kriteria[$sub->kriteria->id] = $sub->kriteria->nama;
                                            }
                                        }
                                    @endphp
                                    @foreach ($kriteria as $index => $namaKriteria)
                                        <th class="fw-bold">{{ $namaKriteria }} (K{{ $index }})</th>
                                    @endforeach
                                </tr>
                                <tbody>
                                    @foreach ($tanamans as $tanaman)
                                        <tr class="text-center">
                                            <td class="fw-bold">{{ $tanaman->nama }}</td>
                                            @foreach ($tanaman->subkriteria as $subkriteria)
                                                <td>{{ $subkriteria->skor }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-3 mt-4">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive text-nowrap p-0">
                <div class="card">
                    <h5 class="card-header text-dark fw-bold">Hasil Normalisasi</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <tr class="text-center">
                                    <th class="fw-bold">Alternatif</th>
                                    @php
                                        $kriteria = [];
                                        foreach ($tanamans as $tanaman) {
                                            foreach ($tanaman->subkriteria as $sub) {
                                                $kriteria[$sub->kriteria->id] = $sub->kriteria->nama;
                                            }
                                        }
                                    @endphp
                                    @foreach ($kriteria as $index => $namaKriteria)
                                        <th class="fw-bold">{{ $namaKriteria }} (K{{ $index }})</th>
                                    @endforeach
                                </tr>
                                <tbody>
                                    @for ($i = 0; $i < count($nilai_normalisasi[1]); $i++)
                                        <tr class="text-center">
                                            <td class="fw-bold">{{ $nilai_normalisasi[1][$i]['tanaman'] }}</td>
                                            @foreach ($nilai_normalisasi as $kriteria)
                                                <td>{{ $kriteria[$i]['nilai_normalisasi'] }}</td>
                                            @endforeach
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $dataPerhitunganAkhir = collect($dataPerhitunganAkhir)->sortByDesc('total_skor')->values()->all();
    @endphp
    <div class="card p-3 mt-4">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive text-nowrap p-0">
                <div class="card">
                    <h5 class="card-header text-dark fw-bold">Menentukkan Skor Akhir dan Perankingan</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th class="fw-bold">Rangking</th>
                                        <th class="fw-bold">Alternatif</th>
                                        @if (!empty($dataPerhitunganAkhir) && isset($dataPerhitunganAkhir[0]['skor_akhir']))
                                            @foreach ($dataPerhitunganAkhir[0]['skor_akhir'] as $index => $nilai)
                                                <th class="fw-bold">K{{ $index }}</th>
                                            @endforeach
                                        @endif
                                        <th class="fw-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPerhitunganAkhir as $rank => $tanaman)
                                        <tr class="text-center">
                                            <td class="fw-bold">{{ $rank + 1 }}</td>
                                            <td class="fw-bold">{{ $tanaman['nama_tanaman'] }}</td>
                                            @foreach ($tanaman['skor_akhir'] as $nilai)
                                                <td>{{ number_format($nilai, 8) }}</td>
                                            @endforeach
                                            <td>{{ number_format($tanaman['total_skor'], 8) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
