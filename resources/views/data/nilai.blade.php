@extends('layouts.backend')

@section('content')
<!-- Elemen untuk menampilkan pesan toast, awalnya tersembunyi -->
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
                <h5 class="card-title">Daftar Kelas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Total Siswa</th>
                                    <th scope="col">Daftar Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $key => $kelasItem)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $kelasItem->kelas }}</td>
                                    <td>{{ $kelasItem->siswas_count }}</td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#kelas{{ $key + 1 }}">
                                            <span class="tf-icons bx bx-list-ul"></span>
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
    </div>
</div>

@foreach ($kelas as $key => $kelasItem)
<div class="modal fade" id="kelas{{ $key + 1 }}" tabindex="-1" aria-labelledby="kelas{{ $key + 1 }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kelas{{ $key + 1 }}Label">Daftar Siswa Kelas {{ $kelasItem->kelas }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">QrCode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelasItem->siswas as $index => $siswa)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $siswa->nama }}</td>
                                    <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $siswa->unique }}" alt="QRCode {{ $siswa->nama }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
