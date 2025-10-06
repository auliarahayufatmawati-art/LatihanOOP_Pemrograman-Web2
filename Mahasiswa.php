<?php
require_once 'User.php';
require_once 'Login.php';

class Mahasiswa extends User implements Login {
    private $nim;

    public function __construct($nama, $nim) {
        parent::__construct($nama);
        $this->nim = $nim;
    }

    public function getRole() {
        return "Mahasiswa";
    }

    public function tampilkanInfoUser() {
        return [
            'Nama' => $this->getNama(),
            'Role' => $this->getRole(),
            'NIM' => $this->nim
        ];
    }

    public function login($username, $password) {
        return $password == "1234" ? "Login berhasil" : "Login gagal";
    }
}
?>