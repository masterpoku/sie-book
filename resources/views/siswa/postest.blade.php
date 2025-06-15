<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Postest Esai - {{ $submateri->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-relaxed">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Postest Esai - {{ $submateri->nama }}</h1>
                <a href="{{ route('indexsiswa.index') }}" class="hover:underline">Kembali ke Beranda</a>
            </div>
        </header>

        <!-- Flash Message -->
        @if(session('message'))
            <div class="container mx-auto mt-4">
                <div class="p-4 bg-green-100 text-green-800 rounded">
                    @if (session('message.type') === 'success')
                        {{ session('message.content') }}
                    @endif
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-grow container mx-auto p-6 bg-white mt-4 rounded shadow">
            <form action="{{ route('siswa.postest.submit', $submateri->id) }}" method="POST">
                @csrf

                @foreach ($quizzes as $index => $quiz)
                    <div class="mb-6">
                        <label class="block font-semibold mb-2 text-gray-700">Soal {{ $index + 1 }}</label>
                        <div class="bg-gray-100 p-3 rounded mb-2 text-gray-800">
                            {!! $quiz->pertanyaan !!}
                        </div>
                        <textarea name="jawaban[{{ $quiz->id }}]" rows="5" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tulis jawabanmu di sini..."></textarea>
                    </div>
                @endforeach

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Kirim Jawaban
                </button>
            </form>
        </main>

        <!-- Footer -->
        <footer class="bg-blue-600 text-white p-4 mt-8 text-center">
            <p>&copy; {{ date('Y') }} DiGiDuGo. Semua Hak Dilindungi.</p>
        </footer>
    </div>
</body>
</html>
