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

<div class="row" style="margin-top: 50px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Koreksi Jawaban Postest</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $siswa)
                            <tr>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>
                                    <a href="{{ route('guru.koreksi.detail', $siswa->id) }}" class="btn btn-primary btn-sm">
                                        Koreksi Jawaban
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @if ($siswas->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">Belum ada jawaban siswa.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
