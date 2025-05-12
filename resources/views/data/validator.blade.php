<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Daftar Validasi</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Validitas</th>
                    <th class="border p-2">Indikator</th>
                    <th class="border p-2">Pernyataan</th>
                    <th class="border p-2">Skor</th>
                    <th class="border p-2">Catatan</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($validator as $data) : ?>
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border p-2"><?= $data->validitas; ?></td>
                        <td class="border p-2"><?= $data->indikator; ?></td>
                        <td class="border p-2"><?= $data->pernyataan; ?></td>
                        <td class="border p-2"><input type='number' value='<?= $data->skor; ?>' id='skor_<?= $data->id; ?>' class="w-full border p-1" <?= $data->skor != 0 ? 'disabled' : ''; ?>></td>
                        <td class="border p-2"><input type='text' value='<?= $data->catatan; ?>' id='catatan_<?= $data->id; ?>' class="w-full border p-1" <?= !empty($data->catatan) ? 'disabled' : ''; ?>></td>
                        <td class="border p-2 text-center">
                            <button onclick='updateData(<?= $data->id; ?>)' class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-700">Simpan</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function updateData(id) {
            let skor = document.getElementById('skor_' + id).value;
            let catatan = document.getElementById('catatan_' + id).value;
            
            fetch('/update-data', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                },
                body: JSON.stringify({ id, skor, catatan })
            })
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => alert('Gagal memperbarui data'));
        }
    </script>
</body>
</html>
