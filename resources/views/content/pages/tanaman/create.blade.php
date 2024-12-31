@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Tanaman')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Tanaman</h5>
                </div>
                <div class="card-body">
                    <form action="/tanaman" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Tanaman</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="basic-default-name"
                                    placeholder="Masukkan Nama Tanaman" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Upload Gambar Tanaman</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="gambar" accept=".png,.jpg"
                                    id="basic-default-company" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-deskripsi">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="deskripsi" id="basic-default-deskripsi" placeholder="Masukkan Deskripsi Tanaman"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                        @foreach ($kriteria as $item)
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"
                                    for="basic-default-company">{{ $item->nama }}</label>
                                <div class="col-sm-10">
                                    <select name="subkriteria_id[]" class="form-select" required>
                                        <option value="" selected disabled>Tentukan Opsi</option>
                                        @foreach ($item->subkriteria as $subkriteria)
                                            <option value="{{ $subkriteria->id }}">{{ $subkriteria->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Data Tanaman</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
