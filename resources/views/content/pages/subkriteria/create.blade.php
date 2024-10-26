@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Subkriteria')

@section('content')
    <style>
        .swal2-container {
            z-index: 10000 !important;
        }
    </style>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Subkriteria</h5>
                    <button id="tambahSubkriteriaBaru" class="btn btn-dark">Tambah Subkriteria Baru</button>
                </div>
                <div class="card-body">
                    <form action="/subkriteria" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="formKriteriaContainer">
                            <div class="form-kriteria mb-3">
                                <div class="row mb-5">
                                    <label class="col-sm-2 col-form-label">Kriteria</label>
                                    <div class="col-sm-10">
                                        <select name="kriteria_id" class="form-select" required>
                                            <option value="" selected disabled>Pilih Kriteria</option>
                                            @foreach ($kriteria as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Subkriteria</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama[]"
                                            placeholder="Masukkan Nama Subkriteria" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Skor Subkriteria</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="skor[]" step="0.01"
                                            value="0" min="0" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Semua Subkriteria</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('tambahSubkriteriaBaru').addEventListener('click', function() {
            const container = document.getElementById('formKriteriaContainer');
            const newForm = document.createElement('div');
            newForm.classList.add('form-kriteria', 'mb-3');
            newForm.innerHTML = `
                <div class="row mb-3 mt-5">
                    <label class="col-sm-2 col-form-label">Nama Subkriteria</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama[]"
                            placeholder="Masukkan Nama Subkriteria" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Skor Subkriteria</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="skor[]" step="0.01"
                            value="0" min="0" required />
                    </div>
                </div>
            `;
            container.appendChild(newForm);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
            });
        </script>
    @endif
@endsection
