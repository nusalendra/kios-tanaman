<div class="row mb-5">
    <div>
        @foreach ($dataPerhitunganAkhir->chunk(4) as $row)
            <div class="row mb-5">
                @foreach ($row as $item)
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <img class="card-img-top"
                                        src="{{ asset('storage/gambar-tanaman/' . ($item['gambar'] ?? 'Bunga Putih.jpg')) }}"
                                        alt="Card image" />
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item['nama_tanaman'] }}</h5>
                                        <p class="card-text">
                                            @foreach ($item['kriteria'] as $kriteria)
                                                @if ($kriteria['nama_kriteria'] === 'Harga')
                                                    <strong
                                                        class="text-primary">{{ $kriteria['nama_subkriteria'] }}{{ !$loop->last ? ',' : '' }}</strong>
                                                @endif
                                            @endforeach
                                        </p>
                                        <p class="card-text">
                                            {{ \Illuminate\Support\Str::limit($item['deskripsi'], 100, '...') }}
                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary show-modal"
                                            data-nama="{{ $item['nama_tanaman'] }}"
                                            data-deskripsi="{{ $item['deskripsi'] }}"
                                            data-gambar="{{ asset('storage/gambar-tanaman/' . ($item['gambar'] ?? 'Bunga Putih.jpg')) }}"
                                            data-kriteria='@json($item['kriteria'])'>
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
    </script>
</div>
