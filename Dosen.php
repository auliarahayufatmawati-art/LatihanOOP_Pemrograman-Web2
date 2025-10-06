<?php
require_once 'User.php';
require_once 'Login.php';

class Dosen extends User implements Login {
    private $nidn;

    public function __construct($nama, $nidn) {
        parent::__construct($nama);
        $this->nidn = $nidn;
    }

    public function getRole() {
        return "Dosen";
    }

    public function tampilkanInfoUser() {
        return [
            'Nama' => $this->getNama(),
            'Role' => $this->getRole(),
            'NIDN' => $this->nidn
        ];
    }

    public function login($username, $password) {
        return $password == "1234" ? "Login berhasil" : "Login gagal";
    }
}
?>