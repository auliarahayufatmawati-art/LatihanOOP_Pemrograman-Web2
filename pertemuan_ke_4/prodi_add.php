<?php
require "Database.php";
$conn = Database::getInstance()->getConnection();

if ($_POST) {
    $sql = "INSERT INTO prodi (nama_prodi, kode_prodi, status, jenjang, kaprodi, fakultas)
            VALUES (:nama, :kode, :status, :jenjang, :kaprodi, :fakultas)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nama'     => $_POST['nama_prodi'],
        ':kode'     => $_POST['kode_prodi'],
        ':status'   => $_POST['status'],
        ':jenjang'  => $_POST['jenjang'],
        ':kaprodi'  => $_POST['kaprodi'],
        ':fakultas' => $_POST['fakultas']
    ]);

    header("Location: prodi_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Tambah Prodi</h2>

<form method="POST">
    Nama Prodi: <input type="text" name="nama_prodi"><br><br>
    Kode Prodi: <input type="text" name="kode_prodi"><br><br>
    Status:
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="tidak aktif">Tidak Aktif</option>
    </select><br><br>
    Jenjang: <input type="text" name="jenjang"><br><br>
    Kaprodi: <input type="text" name="kaprodi"><br><br>
    Fakultas: <input type="text" name="fakultas"><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>