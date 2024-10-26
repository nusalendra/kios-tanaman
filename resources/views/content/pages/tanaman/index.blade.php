@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Tanaman')

@section('content')
    <style>
        .swal2-container {
            z-index: 10000 !important;
        }
    </style>
    <div class="text-end mb-3">
        <a href="/tanaman/create" class="btn btn-dark">Tambah Tanaman</a>
    </div>
    <div class="card p-3">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive text-nowrap p-0">
                <table id="myTable" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-start">Tanaman</th>
                            @foreach ($kriteria as $item)
                                <th class="text-uppercase text-xs font-weight-bolder text-start">{{ $item->nama }}</th>
                            @endforeach
                            <th class="text-uppercase text-xs font-weight-bolder text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $tanaman)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $tanaman->nama }}</h6>
                                        </div>
                                    </div>
                                </td>

                                @foreach ($kriteria as $item)
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                @php
                                                    $subkriteriaTerpilih = $tanaman->subkriteria->filter(function (
                                                        $sub,
                                                    ) use ($item) {
                                                        return $sub->kriteria_id == $item->id;
                                                    });
                                                @endphp

                                                @if ($subkriteriaTerpilih->isNotEmpty())
                                                    {{ $subkriteriaTerpilih->pluck('nama')->implode(', ') }}
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                @endforeach

                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="/tanaman/{{ $tanaman->id }}/edit">
                                                <button type="button" class="btn btn-warning">
                                                    Edit
                                                </button>
                                            </a>
                                        </div>
                                        <div class="ms-2 d-flex flex-column justify-content-center">
                                            <form id="delete-form-{{ $tanaman->id }}" action="/tanaman/{{ $tanaman->id }}"
                                                method="POST" role="form text-left"
                                                onsubmit="event.preventDefault(); hapusData({{ $tanaman->id }})">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                <script>
                    let table = new DataTable('#myTable');
                </script>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function hapusData(id) {
            Swal.fire({
                title: "Hapus Tanaman?",
                text: "Tanaman akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
