@extends('layouts.backend')

@section('content')
<div class="row">
    <div style="margin-top: 80px" class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">SIE-BOOK</h5>
                        <p class="mb-4">
                            Fitur buku dan latihan soal tersedia untuk meningkatkan pemahaman konsep siswa. Hubungi developer kami untuk informasi lebih lanjut.
                        </p>
                        <a href="https://wa.me/6281554850403" class="btn btn-sm btn-outline-primary">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('template/templateAdmin/assets/img/illustrations/man-with-laptop-light.png') }}" height="170" alt="View Badge User" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('template/templateAdmin/assets/img/icons/unicons/terkirim.png') }}" alt="Total Pelajaran" class="rounded" />
                    </div>
                    <span class="fw-semibold" style="margin-left: 20px">Total MaPel</span>
                </div>
                <h3 class="card-title mb-2 text-center" id="totalLessons">{{ $mapelCount }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('template/templateAdmin/assets/img/icons/unicons/diterima.png') }}" alt="Pesan Di Terima" class="rounded" />
                    </div>
                    <span class="fw-semibold">Total Siswa</span>
                </div>
                <h3 class="card-title mb-2 text-center" id="totalMessages">{{$siswaCount}}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('template/templateAdmin/assets/img/icons/unicons/gagal.png') }}" alt="Pesan Tidak Terkirim" class="rounded" />
                    </div>
                    <span class="fw-semibold" style="margin-left: 20px">Total Kelas
                </div>
                <h3 class="card-title mb-2 text-center" id="totalFailedMessages">{{$kelasCount}}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
