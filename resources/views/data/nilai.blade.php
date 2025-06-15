@extends('layouts.backend')

@section('content')

@if (session('message'))
    <div class="bs-toast toast toast-placement-ex m-2 {{ session('message.type') === 'success' ? 'bg-success' : 'bg-danger' }}" id="modalMessageToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">
                {{ session('message.type') === 'success' ? 'Sukses' : 'Error' }}
            </div>
            <small>just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('message.content') }}
        </div>
    </div>
@endif

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Kelas</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kelas</th>
                            <th>Total Siswa</th>
                            <th>Daftar Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $key => $kelasItem)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $kelasItem->kelas }}</td>
                            <td>{{ count($kelasItem->siswas) }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kelas{{ $key + 1 }}">
                                    Lihat
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($kelas as $key => $kelasItem)
<div class="modal fade" id="kelas{{ $key + 1 }}" tabindex="-1" aria-labelledby="kelas{{ $key + 1 }}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kelas{{ $key + 1 }}Label">Daftar Nilai Siswa - Kelas {{ $kelasItem->kelas }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Submateri / Nilai</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelasItem->siswas as $siswa)
                            <tr>
                                <td>{{ $siswa->nama }}</td>
                                <td>
                                    @if ($siswa->jawabanEsai->isNotEmpty())
                                        <ul class="mb-0 ps-3">
                                            @php
                                                $nilaiPerSubmateri = [];
                                            @endphp
                                            @foreach ($siswa->jawabanEsai as $jawaban)
                                                @php
                                                    $namaSubmateri = $jawaban->nama_submateri ?? 'Submateri?';
                                                    if (!isset($nilaiPerSubmateri[$namaSubmateri])) {
                                                        $nilaiPerSubmateri[$namaSubmateri] = 0;
                                                    }
                                                    $nilaiPerSubmateri[$namaSubmateri] += $jawaban->penilaian ?? 0;
                                                @endphp
                                            @endforeach
                                            @foreach ($nilaiPerSubmateri as $submateri => $totalNilai)
                                                <li><strong>{{ $submateri }}</strong>: {{ $totalNilai }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">Belum ada jawaban</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Tidak ada siswa di kelas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
