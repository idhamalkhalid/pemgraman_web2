<?php
// SALAH: variabel $a dan $_GET['test'] dipakai sebelum didefinisikan
// Pesan: Undefined variable $a / Undefined array key "test"
// (PHP 7 menampilkan Notice, PHP 8 menampilkan Warning)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($a > 0) {
    echo "A lebih dari 0<br>";
}
if ($_GET['test'] == 0) {
    echo "test sama dengan 0";
}
?>
