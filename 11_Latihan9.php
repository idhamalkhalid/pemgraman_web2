<?php
$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die("Could not connect: " . mysqli_connect_error());
}

$firstname = $_POST["firstname"] ?? "";
$lastname = $_POST["lastname"] ?? "";
$age = $_POST["age"] ?? "";

$sql = "INSERT INTO tbl_mhs (FirstName, LastName, Age)
        VALUES (?, ?, ?)";

$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    die("Gagal menyiapkan query: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "ssi", $firstname, $lastname, $age);

if (mysqli_stmt_execute($stmt)) {
    echo "1 record added";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>