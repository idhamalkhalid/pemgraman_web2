<?php
// Sesuaikan dengan database Anda (default XAMPP: user root, password kosong)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "lat_dbase";

$Open = mysqli_connect($host, $user, $pass, $db);
if (!$Open) {
    die("Koneksi gagal: " . mysqli_connect_error());
}