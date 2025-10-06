<?php
require_once 'User.php';

class Staff extends User {
    private $departemen;

    public function __construct($nama, $departemen) {
        parent::__construct($nama);
        $this->departemen = $departemen;
    }

    public function getRole() {
        return "Staff";
    }

    public function tampilkanInfoUser() {
        return [
            'Nama' => $this->getNama(),
            'Role' => $this->getRole(),
            'Departemen' => $this->departemen
        ];
    }
}
?>