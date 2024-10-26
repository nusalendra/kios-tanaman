@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Kriteria')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Kriteria</h5>
                    <button id="tambahKriteria" class="btn btn-dark">Tambah Kriteria Baru</button>
                </div>
                <div class="card-body">
                    <form id="kriteriaForm" action="/kriteria" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="formKriteriaContainer">
                            <div class="form-kriteria mb-3">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama[]"
                                            placeholder="Masukkan Nama Kriteria" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tipe Kriteria</label>
                                    <div class="col-sm-10">
                                        <select name="tipe[]" class="form-select" required>
                                            <option value="" selected disabled>Pilih Tipe Kriteria</option>
                                            <option value="Benefit">Benefit</option>
                                            <option value="Cost">Cost</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Bobot Kriteria</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="bobot[]" step="0.01"
                                            value="0" min="0" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Semua Kriteria</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tambahKriteria').addEventListener('click', function() {
            const container = document.getElementById('formKriteriaContainer');
            const newForm = document.createElement('div');
            newForm.classList.add('form-kriteria', 'mb-3');
            newForm.innerHTML = `
                <div class="row mb-3 mt-5">
                    <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama[]" placeholder="Masukkan Nama Kriteria" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Tipe Kriteria</label>
                    <div class="col-sm-10">
                        <select name="tipe[]" class="form-select" required>
                            <option value="" selected disabled>Pilih Tipe Kriteria</option>
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Bobot Kriteria</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="bobot[]" value="0" step="0.01" min="0" required />
                    </div>
                </div>
            `;
            container.appendChild(newForm);
        });
    </script>
@endsection
