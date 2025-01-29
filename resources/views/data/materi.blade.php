@extends('layouts.backend')

@section('content')

@if (session('message'))
<div class="alert {{ session('message.type') === 'success' ? 'alert-success' : 'alert-danger' }}">
    {{ session('message.content') }}
</div>
@endif

<div class="card">
    <h5 class="card-header">Daftar Materi</h5>
    <div class="card-body">
        <!-- Tombol Tambah Materi -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMateriModal">
            Tambah Materi
        </button>
    </div>

    <div class="table-responsive text-nowrap mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Nama Materi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materi as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-sm btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editMateriModal{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('materi.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Materi -->
                    <div class="modal fade" id="editMateriModal{{ $item->id }}" tabindex="-1" aria-labelledby="editMateriLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMateriLabel{{ $item->id }}">Edit Materi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('materi.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="mapel" class="form-label">Mata Pelajaran</label>
                                            <select class="form-control" id="mapel" name="mapel" required>
                                                <!-- Loop through available mapel (subjects) -->
                                                @foreach($mapelList as $mapel)
                                                    <option value="{{ $mapel->mapel }}" {{ $item->mapel == $mapel->mapel ? 'selected' : '' }}>
                                                        {{ $mapel->mapel }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select class="form-control" id="kelas" name="kelas" required>
                                                <!-- Loop through available kelas (classes) -->
                                                @foreach($kelasList as $kelas)
                                                    <option value="{{ $kelas->kelas }}" {{ $item->kelas == $kelas->kelas ? 'selected' : '' }}>
                                                        {{ $kelas->kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Materi</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Edit Materi -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Materi -->
<div class="modal fade" id="addMateriModal" tabindex="-1" aria-labelledby="addMateriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMateriLabel">Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('materi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select class="form-control" id="mapel" name="mapel" required>
                            <!-- Loop through available mapel (subjects) -->
                            @foreach($mapelList as $mapel)
                                <option value="{{ $mapel->mapel }}">{{ $mapel->mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <!-- Loop through available kelas (classes) -->
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Materi</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Materi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal Tambah Materi -->

@endsection
