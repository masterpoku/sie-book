<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Terima Kasih!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md text-center max-w-md w-full">
        <h1 class="text-2xl font-bold text-green-600 mb-4">✅ Jawaban Berhasil Dikirim!</h1>
        <p class="text-gray-700 mb-6">
            Terima kasih telah menyelesaikan postest.<br>
            Jawaban kamu sudah tercatat dengan baik.
        </p>
        <a href="{{ route('indexsiswa.index') }}"
           class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
