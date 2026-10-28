<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs");

if (!$hasil) {
    die("Query gagal: " . mysqli_error($conn));
}

while ($data = mysqli_fetch_array($hasil)) {
    echo $data["FirstName"] . " "
       . $data["LastName"] . " "
       . $data["Age"] . "<br>";
}

mysqli_close($conn);
?>