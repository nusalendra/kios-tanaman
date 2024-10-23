@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Subkriteria')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Subkriteria</h5>
                </div>
                <div class="card-body">
                    <form action="/subkriteria/{{ $subkriteria->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="formKriteriaContainer">
                            <div class="form-kriteria mb-3">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tanaman</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama Kriteria"
                                            value="{{ $subkriteria->kriteria->tanaman->nama }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama Kriteria" value="{{ $subkriteria->kriteria->nama }}"
                                            readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Subkriteria</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama Kriteria" value="{{ $subkriteria->nama }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Skor Subkriteria</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="skor" step="0.01"
                                            value="{{ $subkriteria->skor }}" min="0" />
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
