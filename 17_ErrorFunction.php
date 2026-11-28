<?php

class mahasiswa {
    public $nama = "Idham";

    public function tampilkanNama() {
        echo "Nama: ". $this->nama;
        echo "<br>";
    }
    public function tampilkanAlamat() {
        echo "Alamat: Tangsel";
    }
}

$mhs = new Mahasiswa();
$mhs->tampilkanNama();
$mhs->tampilkanAlamat();
?>