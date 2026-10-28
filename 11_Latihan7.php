<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs");

if (!$hasil) {
    die("Query gagal: " . mysqli_error($conn));
}

$hit = mysqli_num_rows($hasil);

echo "jumlah record $hit";

mysqli_close($conn);
?>