<?php
$conn = mysqli_connect("localhost", "root", "");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$dbname = "lat_dbase";

$sql = "CREATE DATABASE $dbname";

if (mysqli_query($conn, $sql)) {
    echo "Database $dbname berhasil dibuat";
} else {
    echo "Couldn't Create Database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>