<?php
require "Database.php";
$conn = Database::getInstance()->getConnection();

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM prodi WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $sql = "UPDATE prodi SET 
                nama_prodi = :nama,
                kode_prodi = :kode,
                status = :status,
                jenjang = :jenjang,
                kaprodi = :kaprodi,
                fakultas = :fakultas
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nama'     => $_POST['nama_prodi'],
        ':kode'     => $_POST['kode_prodi'],
        ':status'   => $_POST['status'],
        ':jenjang'  => $_POST['jenjang'],
        ':kaprodi'  => $_POST['kaprodi'],
        ':fakultas' => $_POST['fakultas'],
        ':id'       => $id
    ]);

    header("Location: prodi_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Edit Prodi</h2>

<form method="POST">
    Nama Prodi: <input type="text" name="nama_prodi" value="<?= $data['nama_prodi'] ?>"><br><br>
    Kode Prodi: <input type="text" name="kode_prodi" value="<?= $data['kode_prodi'] ?>"><br><br>

    Status:
    <select name="status">
        <option value="aktif" <?= ($data['status']=='aktif')?'selected':'' ?>>Aktif</option>
        <option value="tidak aktif" <?= ($data['status']=='tidak aktif')?'selected':'' ?>>Tidak Aktif</option>
    </select><br><br>

    Jenjang: <input type="text" name="jenjang" value="<?= $data['jenjang'] ?>"><br><br>
    Kaprodi: <input type="text" name="kaprodi" value="<?= $data['kaprodi'] ?>"><br><br>
    Fakultas: <input type="text" name="fakultas" value="<?= $data['fakultas'] ?>"><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>