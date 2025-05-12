<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User - Mata Pelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">DiGiDuGo</h1>
                <nav>
                    <ul class="flex space-x-4">
                        <li><a href="{{ route('indexsiswa.index') }}" class="hover:underline">Beranda</a></li>
                        <li><a href="{{ route('indexsiswa.soal') }}" class="hover:underline">Soal Pretest</a></li>
                        <li><a href="{{ route('indexsiswa.soal') }}" class="hover:underline">Soal Postest</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Sidebar Mata Pelajaran -->
                <aside class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-bold mb-4">Materi Pelajaran</h2>
                    <ul class="space-y-2">
                        @php use Illuminate\Support\Str; @endphp

                        @foreach($materi as $mapel => $materiList)
                            <li>
                                <!-- Tombol Mata Pelajaran -->
                                <button class="w-full text-left p-2 bg-blue-100 rounded hover:bg-blue-200" onclick="toggleSubMenu('{{ Str::slug($mapel) }}')">
                                    {{ $mapel }} <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul id="{{ Str::slug($mapel) }}" class="hidden pl-4 mt-2 space-y-2">
                                    @foreach($materiList as $materi => $subMateriList)
                                        <li>
                                            <!-- Tombol Materi -->
                                            <button class="w-full text-left p-2 bg-green-100 rounded hover:bg-green-200" onclick="toggleSubMenu('{{ Str::slug($mapel . '-' . $materi) }}')">
                                                {{ $materi }} <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <ul id="{{ Str::slug($mapel . '-' . $materi) }}" class="hidden pl-4 mt-2 space-y-2">
                                                @foreach($subMateriList as $subMateri)
                                                    <!-- Submateri -->
                                                    <li>
                                                        <a href="#" onclick="showContent('{{ $subMateri }}')" class="block p-2 bg-gray-100 rounded hover:bg-gray-200">
                                                            {{ $subMateri }} 
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </aside>
                @php
                    $siswa = session('siswa');
                @endphp
                <!-- Konten Materi -->
                <section class="col-span-2 bg-white p-4 rounded shadow" id="main-content">
                    <h1 class="text-xl font-bold mb-4" id="content-title">Hallo Siswa Teladan<br>{{ ucwords($siswa['nama'] ?? 'Nama tidak tersedia') }}</h1>

                    <div id="content-text">{!! $konten['judul_submateri'] ?? 'Silakan pilih sub-materi untuk melihat isi materinya.' !!}</div>


                </section>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-blue-600 text-white p-4">
            <div class="container mx-auto text-center">
                <p>&copy; <script>document.write(new Date().getFullYear());</script> CerdasLearn. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
    // Data konten dari controller
    const kontenMateri = @json($konten);

    function toggleSubMenu(id) {
        const subMenu = document.getElementById(id);
        subMenu.classList.toggle('hidden');
    }

    function showContent(title) {
        document.getElementById('content-title').innerText = title;
        document.getElementById('content-text').innerHTML = kontenMateri[title] || 'Konten belum tersedia.';
    }
</script>

</body>
</html>
