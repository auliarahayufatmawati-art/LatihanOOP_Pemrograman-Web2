<?php
require_once "Database.php";  
$conn = Database::getInstance()->getConnection();

// --- Ambil semua jurusan ---
$jurusanList = $conn->query("SELECT * FROM jurusan")->fetchAll(PDO::FETCH_ASSOC);

// --- Filter ---
$filter = isset($_GET['jurusan']) ? $_GET['jurusan'] : '';

// Query dasar
$sql = "SELECT m.nim, m.nama, j.nama_jurusan 
        FROM mahasiswa m
        JOIN jurusan j ON m.jurusan = j.id";

// Tambah kondisi bila filter dipilih
if ($filter != '') {
    $sql .= " WHERE j.id = :jurusan";
}

$order = isset($_GET['sort']) ? $_GET['sort'] : '';
$allowedSort = ['nama_asc', 'nama_desc', 'nim_asc', 'nim_desc'];

if (in_array($order, $allowedSort)) {
    switch ($order) {
        case 'nama_asc': $sql .= " ORDER BY m.nama ASC"; break;
        case 'nama_desc': $sql .= " ORDER BY m.nama DESC"; break;
        case 'nim_asc': $sql .= " ORDER BY m.nim ASC"; break;
        case 'nim_desc': $sql .= " ORDER BY m.nim DESC"; break;
    }
}

$stmt = $conn->prepare($sql);

if ($filter != '') {
    $stmt->bindParam(':jurusan', $filter, PDO::PARAM_INT);
}

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Data Mahasiswa</h2>

<form method="GET">
    <select name="jurusan">
        <option value="">-- Semua Jurusan --</option>
        <?php foreach($jurusanList as $j): ?>
            <option value="<?= $j['id'] ?>" <?= ($filter == $j['id']) ? 'selected' : '' ?>>
                <?= $j['nama_jurusan'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="sort">
        <option value="">-- Urutkan --</option>
        <option value="nama_asc">Nama ASC</option>
        <option value="nama_desc">Nama DESC</option>
        <option value="nim_asc">NIM ASC</option>
        <option value="nim_desc">NIM DESC</option>
    </select>

    <button type="submit">Terapkan</button>
</form>

<br>

<?php if (count($data) == 0): ?>
    <p><b>Tidak ada data mahasiswa yang ditemukan.</b></p>
<?php else: ?>
<table border="1" cellpadding="8">
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jurusan</th>
    </tr>

    <?php foreach($data as $row): ?>
    <tr>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['nama_jurusan'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>
