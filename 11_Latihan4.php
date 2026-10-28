<?php
$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die("Could not connect: " . mysqli_connect_error());
}

$sql1 = "INSERT INTO tbl_mhs (FirstName, LastName, Age)
         VALUES ('Karina', 'Suwandi', 29)";

$sql2 = "INSERT INTO tbl_mhs (FirstName, LastName, Age)
         VALUES ('Glenn', 'Gandari', 32)";

if (mysqli_query($con, $sql1)) {
    echo "Data Karina berhasil ditambahkan.<br>";
} else {
    echo "Gagal menambahkan data Karina: " . mysqli_error($con) . "<br>";
}

if (mysqli_query($con, $sql2)) {
    echo "Data Glenn berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan data Glenn: " . mysqli_error($con);
}

mysqli_close($con);
?>