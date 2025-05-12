@extends('layouts.backend')

@section('content')
<div class="card" style="padding: 10px; margin-top: 50px;">
    <h5 class="card-header">Daftar Validasi</h5>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addValidasiModal">
            Tambah Validasi
        </button>
    </div>

    <!-- Tabel Daftar Validasi -->
    <div class="table-responsive text-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Validitas</th>
                    <th>Indikator</th>
                    <th>Pernyataan</th>
                    <th>Skor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $groupedValidasi = $validasi->groupBy(['validitas', 'indikator']);
                    $no = 1;
                @endphp

                @foreach ($groupedValidasi as $validitas => $indikatorGroup)
                    @foreach ($indikatorGroup as $indikator => $items)
                        @php
                            $firstItem = $items->first();
                            $modalId = "modal_{$no}";
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $firstItem->validitas }}</td>
                            <td>{{ $firstItem->indikator }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                    Lihat Pernyataan
                                </button>
                            </td>
                            <td>{{ $items->sum('skor') }}</td>
                            <td>
             
                                <form action="{{ route('validasi.destroy', $firstItem->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://{{ request()->getHost() }}/validasi/{{ $firstItem->validitas }}" alt="QRCode {{ $firstItem->validitas }}"></td>
                            </td>
                        </tr>

                        <!-- Modal Pernyataan -->
                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="pernyataanModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Pernyataan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($items as $item)
                                                <li>{{ $item->pernyataan }} - {{ $item->skor }} -  {{ $item->catatan }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php $no++; @endphp
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Validasi -->
    <div class="modal fade" id="addValidasiModal" tabindex="-1" aria-labelledby="addValidasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('validasi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addValidasiModalLabel">Tambah Validasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input Validitas -->
                        <div class="mb-3">
                            <label for="validitas" class="form-label">Validitas</label>
                            <input type="text" name="validitas" id="validitas" class="form-control" required>
                        </div>

                        <!-- Input Indikator -->
                        <div class="mb-3">
                            <label for="indikator" class="form-label">Indikator</label>
                            <input type="text" name="indikator" id="indikator" class="form-control" required>
                        </div>

                        <!-- Input Pernyataan -->
                        <div class="mb-3">
                            <label for="pernyataan" class="form-label">Pernyataan</label>
                            <textarea name="pernyataan" id="pernyataan" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Input Skor -->
                        <div class="mb-3">
                            <label for="skor" class="form-label">Skor</label>
                            <input type="number" name="skor" id="skor" class="form-control" min="0" max="5" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
