@extends('layouts.backend')

@section('content')

@if (session('message'))
<div class="alert {{ session('message.type') === 'success' ? 'alert-success' : 'alert-danger' }}">
    {{ session('message.content') }}
</div>
@endif

<div class="card">
    <h5 class="card-header">Daftar Kelas</h5>
    <div class="card-body">
        <!-- Tombol Tambah Kelas -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKelasModal">
            Tambah Kelas
        </button>
    </div>

    <div class="table-responsive text-nowrap mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-sm btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editKelasModal{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Kelas -->
                    <div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="editKelasLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKelasLabel{{ $item->id }}">Edit Kelas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Nama Kelas</label>
                                            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $item->kelas }}" required>
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
                    <!-- /Modal Edit Kelas -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kelas -->
<div class="modal fade" id="addKelasModal" tabindex="-1" aria-labelledby="addKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKelasLabel">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Nama Kelas" required>
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
<!-- /Modal Tambah Kelas -->

@endsection
