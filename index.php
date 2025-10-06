<?php
require_once 'Mahasiswa.php';
require_once 'Dosen.php';
require_once 'Staff.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan OOP - Pemrograman Web 2</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1>Latihan OOP - Pemrograman Web 2</h1>

<table>
    <tr>
        <th>Nama</th>
        <th>Role</th>
        <th>Info Tambahan</th>
        <th>Hasil Login</th>
    </tr>

    <?php
    $users = [
        new Mahasiswa("Aulia", "23001"),
        new Dosen("Pak Budi", "198765"),
        new Staff("Ibu Rina", "Keuangan")
    ];

    foreach ($users as $user) {
        $info = $user->tampilkanInfoUser();
        echo "<tr>";
        echo "<td>{$info['Nama']}</td>";
        echo "<td>{$info['Role']}</td>";

        if (isset($info['NIM'])) echo "<td>{$info['NIM']}</td>";
        elseif (isset($info['NIDN'])) echo "<td>{$info['NIDN']}</td>";
        else echo "<td>{$info['Departemen']}</td>";

        if ($user instanceof Login) {
            $hasilLogin = $user->login("username", "1234");
            echo "<td class='login-result'>$hasilLogin</td>";
        } else {
            echo "<td>Tidak dapat login</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>