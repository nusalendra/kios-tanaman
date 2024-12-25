@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
    $isMenu = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('content')
    <style>
        .swal2-container {
            z-index: 10000 !important;
        }

        .swal-wide-popup {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        table {
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        table td {
            font-size: 13px;
        }

        .text-justify {
            white-space: pre-line;
        }
    </style>
    <div class="form-check">
        <input class="form-check-input" id="check" type="checkbox" value="">
        <label class="form-check-label" for="check">
            Rekomendasi Terbaik
        </label>
    </div>

    <div id="tanaman-container" class="layout-demo-wrapper">
        <div class="row mb-5">
            <div id="flower-container">
                @foreach ($tanaman->chunk(4) as $row)
                    <div class="row mb-5">
                        @foreach ($row as $item)
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-12">
                                            <img class="card-img-top"
                                                src="{{ asset('storage/gambar-tanaman/' . $item->gambar) }}"
                                                alt="Card image" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->nama }}</h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 100, '...') }}
                                                </p>
                                                <a href="javascript:void(0)" class="btn btn-outline-primary show-modal"
                                                    data-nama="{{ $item->nama }}" data-jenis="{{ $item->jenis }}"
                                                    data-deskripsi="{{ $item->deskripsi }}"
                                                    data-gambar="{{ asset('storage/gambar-tanaman/' . $item->gambar) }}"
                                                    data-kriteria='@json(
                                                        $item->subkriteria->map(function ($sub) {
                                                            return [
                                                                'nama_kriteria' => $sub->kriteria->nama,
                                                                'nama_subkriteria' => $sub->nama,
                                                            ];
                                                        }))'>
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).on('click', '.show-modal', function() {
                const nama = $(this).data('nama');
                const deskripsi = $(this).data('deskripsi');
                const gambar = $(this).data('gambar');
                const kriteria = $(this).data('kriteria'); // Format JSON

                let kriteriaRows = '';
                if (kriteria) {
                    kriteria.forEach(criterion => {
                        kriteriaRows += `
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;">${criterion.nama_kriteria}</td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd; text-align: right;">${criterion.nama_subkriteria}</td>
                            </tr>
                        `;
                    });
                }

                Swal.fire({
                    title: `<h2 style="color: #4CAF50; font-family: Arial, sans-serif;"><strong>${nama}</strong></h2>`,
                    html: `
                        <div style="text-align: left; font-family: Arial, sans-serif; font-size: 14px; color: #333;">
                            <div style="margin-bottom: 15px; text-align: center;">
                                <img src="${gambar}" alt="Gambar Tanaman" style="width: 100%; max-width: 300px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            </div>
                           <p class="text-justify fs-6">${deskripsi}</p>
                            <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #f9f9f9; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                <thead>
                                    <tr style="background-color: #4CAF50; color: white;">
                                        <th style="padding: 10px; text-align: left;">Jenis Tanaman</th>
                                        <th style="padding: 10px; text-align: right;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${kriteriaRows}
                                </tbody>
                            </table>
                        </div>
                    `,
                    width: '60%',
                    customClass: {
                        popup: 'swal-wide-popup'
                    },
                    showCloseButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fas fa-check"></i> Tutup',
                    confirmButtonColor: '#4CAF50'
                });
            });

            $('#check').on('change', function() {
                if (this.checked) {
                    $.ajax({
                        url: "{{ route('perhitungan-saw') }}",
                        type: 'GET',
                        success: function(response) {
                            $('#tanaman-container').html(response);
                        },
                        error: function() {
                            Swal.fire("Error", "Terjadi kesalahan saat memuat data.", "error");
                        }
                    });
                } else {
                    $.ajax({
                        url: "{{ route('fetch-all-data-tanaman') }}",
                        type: 'GET',
                        success: function(response) {
                            const chunkSize = 4;
                            let tanamanHtml = '<div id="flower-container">';

                            const truncateText = (text, maxLength) => {
                                if (text.length <= maxLength) {
                                    return text;
                                }

                                const truncated = text.substring(0, maxLength);

                                const lastSpaceIndex = truncated.lastIndexOf(" ");
                                return lastSpaceIndex > 0 ? truncated.substring(0, lastSpaceIndex) +
                                    "..." : truncated + "...";
                            };

                            const createCard = (item) => {
                                const kriteriaData = item.subkriteria.map(sub => ({
                                    nama_kriteria: sub.kriteria.nama,
                                    nama_subkriteria: sub.nama
                                }));

                                const truncatedDescription = truncateText(item.deskripsi, 100);

                                return `
                                <div class="col-md-3">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-12">
                                                <img class="card-img-top" src="{{ asset('storage/gambar-tanaman/') }}/${item.gambar}" alt="Card image" />
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <h5 class="card-title">${item.nama}</h5>
                                                    <p class="card-text">${truncatedDescription}</p>
                                                    <a href="javascript:void(0)" class="btn btn-outline-primary show-modal"
                                                        data-nama="${item.nama}" 
                                                        data-deskripsi="${item.deskripsi}" 
                                                        data-gambar="{{ asset('storage/gambar-tanaman/') }}/${item.gambar}"
                                                        data-kriteria='${JSON.stringify(kriteriaData)}'>
                                                        Lihat Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            };

                            // Membagi data menjadi chunks
                            for (let i = 0; i < response.length; i += chunkSize) {
                                tanamanHtml += '<div class="row mb-5">';
                                response.slice(i, i + chunkSize).forEach(item => {
                                    tanamanHtml += createCard(item);
                                });
                                tanamanHtml += '</div>';
                            }

                            tanamanHtml += '</div>';
                            $('#tanaman-container').html(tanamanHtml);
                        },
                        error: function() {
                            Swal.fire("Error", "Terjadi kesalahan saat memuat data.", "error");
                        }
                    });
                }
            });
        </script>
    @endsection
