<?php
require "Database.php";
$conn = Database::getInstance()->getConnection();

$stmt = $conn->prepare("SELECT * FROM prodi ORDER BY id DESC");
$stmt->execute();
$prodi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<body>

<h2>Data Prodi / Jurusan</h2>
<a href="prodi_add.php">Tambah Prodi</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Nama Prodi</th>
    <th>Kode</th>
    <th>Status</th>
    <th>Jenjang</th>
    <th>Kaprodi</th>
    <th>Fakultas</th>
    <th>Aksi</th>
</tr>

<?php foreach ($prodi as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['nama_prodi'] ?></td>
    <td><?= $p['kode_prodi'] ?></td>
    <td><?= $p['status'] ?></td>
    <td><?= $p['jenjang'] ?></td>
    <td><?= $p['kaprodi'] ?></td>
    <td><?= $p['fakultas'] ?></td>
    <td>
        <a href="prodi_edit.php?id=<?= $p['id'] ?>">Edit</a> | 
        <a href="prodi_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>