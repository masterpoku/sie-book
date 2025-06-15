@extends('layouts.backend')

@section('content')
<h4 class="fw-bold py-3 mb-4">Koreksi Jawaban Siswa</h4>

@foreach ($kelas as $kelasItem)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Kelas {{ $kelasItem['kelas'] }}</h5>
        </div>
        <div class="card-body">
            @if (count($kelasItem['siswa']) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelasItem['siswa'] as $siswa)
                            <tr>
                                <td>{{ $siswa->nama }}</td>
                                <td>
                                    @if (!empty($siswa->submateri_yang_dijawab))
                                        @foreach ($siswa->submateri_yang_dijawab as $submateri)
                                            <a href="{{ route('koreksi.show', [$siswa->id, $submateri->id]) }}" class="btn btn-sm btn-primary mb-1">
                                                Koreksi: {{ $submateri->name }}
                                            </a>
                                        @endforeach

                                    @else
                                        <span class="text-muted">Belum mengerjakan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada siswa di kelas ini.</p>
            @endif
        </div>
    </div>
@endforeach
@endsection
