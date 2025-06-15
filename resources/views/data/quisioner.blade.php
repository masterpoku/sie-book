@extends('layouts.backend')

@section('content')

@if (session('message'))
<div class="alert {{ session('message.type') === 'success' ? 'alert-success' : 'alert-danger' }}">
    {{ session('message.content') }}
</div>
@endif

<div class="card mt-4">
    <h5 class="card-header">Daftar Soal Kuis</h5>
    <div class="card-body">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSoalModal">Tambah Soal</button>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Relasi Materi</th>
                    <th>Submateri</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban Benar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quiz as $quizs)
                <tr>
                    <td>{{ $quizs->id }}</td>
                    <td>{{ $quizs->submateri->materi->mapel ?? 'Tidak ada' }}.{{ $quizs->submateri->materi->kelas ?? 'Tidak ada' }}.{{ $quizs->submateri->materi->name ?? 'Tidak ada' }}</td>
                    <td>{{ $quizs->submateri->name ?? 'Tidak ada' }}</td>
                    <td>{!! Str::limit(strip_tags($quizs->pertanyaan), 50) !!}</td>
                    <td>{{ $quizs->jawaban_benar }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#lihatSoalModal{{ $quizs->id }}">Lihat</button>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSoalModal{{ $quizs->id }}">Edit</button>
                        <form action="{{ route('quiz.destroy', $quizs->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach($quiz as $item)
<!-- Modal Lihat -->
<div class="modal fade" id="lihatSoalModal{{ $item->id }}" tabindex="-1" aria-labelledby="lihatSoalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                {!! $item->pertanyaan !!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editSoalModal{{ $item->id }}" tabindex="-1" aria-labelledby="editSoalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('quiz.update', $item->id) }}" method="POST" onsubmit="return handleEditSubmit({{ $item->id }})">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Soal</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Soal (Pertanyaan)</label>
                        <div id="editQuill{{ $item->id }}" style="height: 200px;">{!! $item->pertanyaan !!}</div>
                        <textarea name="pertanyaan" id="editTextarea{{ $item->id }}" class="form-control d-none"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Jawaban Benar</label>
                        <input type="text" name="jawaban_benar" class="form-control" value="{{ $item->jawaban_benar }}" required>
                    </div>
                    <input type="hidden" name="submateris_id" value="{{ $item->submateris_id }}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Tambah Soal -->
<div class="modal fade" id="tambahSoalModal" tabindex="-1" aria-labelledby="tambahSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('quiz.store') }}" method="POST" onsubmit="document.getElementById('pertanyaan').value = quill.root.innerHTML;">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Soal Kuis</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Submateri</label>
                        <select name="submateris_id" class="form-control" required>
                            @foreach($submateri as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->materi->mapel }}.{{ $sub->materi->kelas }}.{{ $sub->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Pertanyaan</label>
                        <div id="editor" style="height: 200px;"></div>
                        <textarea name="pertanyaan" id="pertanyaan" class="form-control d-none"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Jawaban Benar</label>
                        <input type="text" name="jawaban_benar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- QuillJS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    // Quill untuk tambah soal
    var quill = new Quill('#editor', {
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

    // Quill untuk edit soal
    const editors = {};
    @foreach($quiz as $item)
        editors[{{ $item->id }}] = new Quill("#editQuill{{ $item->id }}", {
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
    @endforeach

    // Fungsi submit edit
    function handleEditSubmit(id) {
        const quillEditor = editors[id];
        const textarea = document.getElementById('editTextarea' + id);
        textarea.value = quillEditor.root.innerHTML;
        return true;
    }
</script>
@endsection
