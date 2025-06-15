@extends('layouts.backend')

@section('content')
<h4 class="fw-bold py-3 mb-4">Jawaban Esai - {{ $siswa->nama }} ({{ $siswa->kelas }})</h4>

@if(session('message'))
    <div class="alert alert-success">{{ session('message.content') }}</div>
@endif

@if (count($jawaban) > 0)
<form action="{{ route('koreksi.nilai', $siswa->id) }}" method="POST">
    @csrf

    @foreach ($jawaban as $index => $item)
        <div class="card mb-3">
            <div class="card-header">
                Soal {{ $index + 1 }} - Sub Materi: {{ $item->nama_submateri }}

            </div>
            <div class="card-body">
                <p><strong>Jawaban Siswa:</strong><br>{{ $item->jawaban }}</p>

                @if ($item->jawaban_benar)
                    <p class="mt-3 text-success"><strong>Jawaban Benar:</strong><br>{{ $item->jawaban_benar }}</p>
                @endif

                <div class="mt-3">
                    <label for="penilaian_{{ $item->id }}" class="form-label">Penilaian:</label>
                    <input type="number" name="penilaian[{{ $item->id }}]" class="form-control" min="0" max="100" value="{{ $item->nilai }}" {{ !empty($item->nilai) ? 'disabled' : '' }}>
                </div>
            </div>
        </div>
    @endforeach

    <button type="submit" class="btn btn-success">Simpan Penilaian</button>
    <a href="{{ route('koreksi.index') }}" class="btn btn-secondary">Kembali ke Daftar Kelas</a>
</form>
@else
    <p>Tidak ada jawaban untuk siswa ini.</p>
@endif
@endsection

