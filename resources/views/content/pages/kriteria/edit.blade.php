@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Kriteria')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Kriteria</h5>
                </div>
                <div class="card-body">
                    <form id="kriteriaForm" action="/kriteria/{{ $kriteria->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="formKriteriaContainer">
                            <div class="form-kriteria mb-3">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama Kriteria" value="{{ $kriteria->nama }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tipe Kriteria</label>
                                    <div class="col-sm-10">
                                        <select name="tipe" class="form-select">
                                            <option value="" selected disabled>Pilih Tipe Kriteria</option>
                                            <option value="Benefit" {{ $kriteria->tipe === 'Benefit' ? 'selected' : '' }}>
                                                Benefit
                                            </option>
                                            <option value="Cost" {{ $kriteria->tipe === 'Cost' ? 'selected' : '' }}>Cost
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Bobot Kriteria</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="bobot" step="0.01"
                                            value="{{ $kriteria->bobot }}" min="0" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
