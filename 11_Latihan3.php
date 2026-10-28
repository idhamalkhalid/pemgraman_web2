<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Membuat tabel
$sql = "CREATE TABLE tbl_mhs (
    mhsID INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (mhsID),
    FirstName VARCHAR(15),
    LastName VARCHAR(15),
    Age INT
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel tbl_mhs berhasil dibuat.<br>";

    // Input data
    $input = mysqli_query(
        $conn,
        "INSERT INTO tbl_mhs (FirstName, LastName, Age)
         VALUES ('Anjar', 'Prabowo', 25)"
    );

    if ($input) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }
} else {
    echo "Gagal membuat tabel: " . mysqli_error($conn);
}

mysqli_close($conn);
?>