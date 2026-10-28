<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs");

if (!$hasil) {
    die("Query gagal: " . mysqli_error($conn));
}

while ($data = mysqli_fetch_row($hasil)) {
    echo "$data[0] $data[1] $data[2] $data[3]<br>";
}

mysqli_close($conn);
?>