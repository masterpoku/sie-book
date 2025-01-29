@extends('layouts.backend')

@section('content')

@if (session('message'))
<div class="alert {{ session('message.type') === 'success' ? 'alert-success' : 'alert-danger' }}">
    {{ session('message.content') }}
</div>
@endif

<div class="card">
    <h5 class="card-header">Daftar Mata Pelajaran</h5>
    <div class="card-body">
        <!-- Tombol Tambah Mata Pelajaran -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMapelModal">
            Tambah Mata Pelajaran
        </button>
    </div>

    <div class="table-responsive text-nowrap mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapel as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-sm btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editMapelModal{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('mapel.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Mata Pelajaran -->
                    <div class="modal fade" id="editMapelModal{{ $item->id }}" tabindex="-1" aria-labelledby="editMapelLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMapelLabel{{ $item->id }}">Edit Mata Pelajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('mapel.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                                            <input type="text" class="form-control" id="mapel" name="mapel" value="{{ $item->mapel }}" required>
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
                    <!-- /Modal Edit Mata Pelajaran -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Mata Pelajaran -->
<div class="modal fade" id="addMapelModal" tabindex="-1" aria-labelledby="addMapelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMapelLabel">Tambah Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mapel.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Masukkan Nama Mata Pelajaran" required>
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
<!-- /Modal Tambah Mata Pelajaran -->

@endsection
