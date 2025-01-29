@extends('layouts.backend')

@section('content')
<div class="card" style="padding: 10px; margin-top: 50px;">
    <h5 class="card-header">Daftar Soal Kuis</h5>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuizModal">
            Tambah Soal
        </button>
    </div>

    <!-- Tabel Daftar Soal -->
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Materi/kelas/Mapel</th>
                    <th>Relasi Submateri</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quiz as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->submateri->materi->name ?? 'Nama tidak ditemukan' }} -
                            {{ $item->submateri->materi->kelas ?? 'Kelas tidak ditemukan' }} -
                            {{ $item->submateri->materi->mapel?? 'Mapel tidak ditemukan' }}
                        </td>
                        <td>{{ $item->submateri->name ?? 'Submateri tidak ditemukan' }}</td> <!-- Menampilkan nama submateri -->
                        <td>{{ $item->pertanyaan }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#jawabanModal{{ $item->id }}">
                                Lihat Jawaban
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="editQuiz({{ $item->id }})">Edit</button>
                            <form action="{{ route('quiz.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Lihat Jawaban -->
                    <div class="modal fade" id="jawabanModal{{ $item->id }}" tabindex="-1" aria-labelledby="jawabanModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="jawabanModalLabel{{ $item->id }}">Jawaban Soal ID: {{ $item->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Jawaban A:</strong> {{ $item->jawaban_a }}</p>
                                    <p><strong>Jawaban B:</strong> {{ $item->jawaban_b }}</p>
                                    <p><strong>Jawaban C:</strong> {{ $item->jawaban_c }}</p>
                                    <p><strong>Jawaban D:</strong> {{ $item->jawaban_d }}</p>
                                    <p><strong>Jawaban Benar:</strong> {{ $item->jawaban_benar }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Lihat Jawaban -->
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data soal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Soal -->
<div class="modal fade" id="addQuizModal" tabindex="-1" aria-labelledby="addQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('quiz.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuizModalLabel">Tambah Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropdown Submateri -->
                    <div class="mb-3">
                        <label for="submateris_id" class="form-label">Pilih Submateri</label>
                        <select name="submateris_id" id="submateris_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Submateri</option>
                            @foreach ($submateri as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->materi->mapel ?? 'Mapel tidak ditemukan' }}-
                                    {{ $item->materi->kelas ?? 'Kelas tidak ditemukan' }} -
                                    {{ $item->materi->name ?? 'Materi tidak ditemukan' }} -
                                    {{ $item->name }} 
                                    
                                  
                                   
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input Pertanyaan -->
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <textarea name="pertanyaan" id="pertanyaan" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_a" class="form-label">Jawaban A</label>
                        <input type="text" name="jawaban_a" id="jawaban_a" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_b" class="form-label">Jawaban B</label>
                        <input type="text" name="jawaban_b" id="jawaban_b" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_c" class="form-label">Jawaban C</label>
                        <input type="text" name="jawaban_c" id="jawaban_c" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_d" class="form-label">Jawaban D</label>
                        <input type="text" name="jawaban_d" id="jawaban_d" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                        <select name="jawaban_benar" id="jawaban_benar" class="form-select" required>
                            <option value="" disabled selected>Pilih Jawaban Benar</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Soal -->
<div class="modal fade" id="editQuizModal" tabindex="-1" aria-labelledby="editQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editQuizForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuizModalLabel">Edit Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropdown Submateri -->
                    <div class="mb-3">
                        <label for="submateris_id" class="form-label">Pilih Submateri</label>
                        <select name="submateris_id" id="submateris_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Submateri</option>
                            @foreach ($submateri as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Input Pertanyaan -->
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <textarea name="pertanyaan" id="pertanyaan" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_a" class="form-label">Jawaban A</label>
                        <input type="text" name="jawaban_a" id="jawaban_a" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_b" class="form-label">Jawaban B</label>
                        <input type="text" name="jawaban_b" id="jawaban_b" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_c" class="form-label">Jawaban C</label>
                        <input type="text" name="jawaban_c" id="jawaban_c" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_d" class="form-label">Jawaban D</label>
                        <input type="text" name="jawaban_d" id="jawaban_d" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                        <select name="jawaban_benar" id="jawaban_benar" class="form-select" required>
                            <option value="" disabled selected>Pilih Jawaban Benar</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Fungsi Hapus
    function deleteQuiz(id) {
        if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
            $.ajax({
                url: `/quiz/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    }

    // Fungsi Edit
    function editQuiz(id) {
        $.get(`/quiz/${id}/edit`, function(data) {
            $('#editQuizForm').attr('action', `/quiz/${id}`);
            $('#pertanyaan').val(data.pertanyaan);
            $('#jawaban_a').val(data.jawaban_a);
            $('#jawaban_b').val(data.jawaban_b);
            $('#jawaban_c').val(data.jawaban_c);
            $('#jawaban_d').val(data.jawaban_d);
            $('#jawaban_benar').val(data.jawaban_benar);
            $('#submateris_id').val(data.submateris_id);
            $('#editQuizModal').modal('show');
        });
    }
</script>
@endsection
