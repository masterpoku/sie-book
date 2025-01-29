@extends('layouts.backend')

@section('content')

@if (session('message'))
<div class="alert {{ session('message.type') === 'success' ? 'alert-success' : 'alert-danger' }}">
    {{ session('message.content') }}
</div>
@endif

<div class="card">
    <h5 class="card-header">Daftar Submateri</h5>
    <div class="card-body">
        <!-- Tombol Tambah Submateri -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubmateriModal">
            Tambah Submateri
        </button>
    </div>

    <div class="table-responsive text-nowrap mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Relasi materi</th>
                    <th>Nama Submateri</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($submateris as $item)
                <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->materi->mapel ?? 'Tidak ditemukan' }}.{{ $item->materi->kelas ?? '' }}.{{ $item->materi->name ?? '' }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <!-- Tombol Tampilkan Deskripsi -->
                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewDescriptionModal{{ $item->id }}">
                    Lihat Deskripsi
                </button>
            </td>
            <td>
                <!-- Tombol Edit -->
                <button type="button" class="btn btn-sm btn-warning" 
                    data-bs-toggle="modal" 
                    data-bs-target="#editSubmateriModal{{ $item->id }}">
                    Edit
                </button>

                <!-- Tombol Hapus -->
                <form action="{{ route('submateris.destroy', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>

              <!-- Modal Tampilkan Deskripsi -->
                <div class="modal fade" id="viewDescriptionModal{{ $item->id }}" tabindex="-1" aria-labelledby="viewDescriptionLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewDescriptionLabel{{ $item->id }}">Deskripsi Submateri</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                {!! $item->description ?? 'Tidak ada deskripsi.' !!}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Modal Tampilkan Deskripsi -->

                    <!-- Modal Edit Submateri -->
                    <div class="modal fade" id="editSubmateriModal{{ $item->id }}" tabindex="-1" aria-labelledby="editSubmateriLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSubmateriLabel{{ $item->id }}">Edit Submateri</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('submateris.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="materi_id" class="form-label">Materi</label>
                                            <select class="form-control" id="materi_id" name="materi_id" required>
                                                @foreach($materis as $materi)
                                                    <option value="{{ $materi->id }}" {{ $item->materi_id == $materi->id ? 'selected' : '' }}>
                                                        {{ $materi->mapel }}.{{ $materi->kelas }}.{{ $materi->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                     
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Submateri</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <div id="editQuill{{ $item->id }}" style="height: 200px;">{!! $item->description ?? '' !!}</div>
                                            <textarea class="form-control d-none" id="description{{ $item->id }}" name="description"></textarea>
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
                    <!-- /Modal Edit Submateri -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Submateri -->
<div class="modal fade" id="addSubmateriModal" tabindex="-1" aria-labelledby="addSubmateriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubmateriLabel">Tambah Submateri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('submateris.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="materi_id" class="form-label">Materi</label>
                        <select class="form-control" id="materi_id" name="materi_id" required>
                            @foreach($materis as $materi)
                                <option value="{{ $materi->id }}">   {{ $materi->mapel }}.{{ $materi->kelas }}.{{ $materi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Submateri</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Submateri" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Submateri</label>
                        <div id="quill" style="height: 200px;"></div>
                        <textarea class="form-control d-none" id="description" name="description"></textarea>
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
<!-- /Modal Tambah Submateri -->

<script>
   var quill = new Quill('#quill', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['link', 'image', 'video'],
            [{ list: 'ordered' }, { list: 'bullet' }]
        ]
    }
});

document.querySelector('form[action="{{ route('submateris.store') }}"]').onsubmit = function(event) {
    var description = document.querySelector('#description');
    description.value = quill.root.innerHTML;
};

@foreach($submateris as $item)
    var editQuill{{ $item->id }} = new Quill('#editQuill{{ $item->id }}', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['link', 'image', 'video'],
                [{ list: 'ordered' }, { list: 'bullet' }]
            ]
        }
    });

    document.querySelector('#editSubmateriModal{{ $item->id }} form').onsubmit = function(event) {
        var description = document.querySelector('#description{{ $item->id }}');
        description.value = editQuill{{ $item->id }}.root.innerHTML;
    };
@endforeach

</script>

@endsection
