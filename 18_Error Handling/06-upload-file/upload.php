<?php
// Upload gagal bila ukuran file melebihi upload_max_filesize / post_max_size (php.ini)
// Solusi: ubah di php.ini, lalu restart Apache
//   upload_max_filesize = 80M
//   post_max_size = 80M
if (!isset($_FILES['berkas'])) {
    die("Tidak ada file yang dikirim (kemungkinan melebihi post_max_size).");
}

$kode = $_FILES['berkas']['error'];

if ($kode === UPLOAD_ERR_OK) {
    $folder = __DIR__ . "/uploads/";
    if (!is_dir($folder)) {
        mkdir($folder);
    }
    $nama = basename($_FILES['berkas']['name']);
    move_uploaded_file($_FILES['berkas']['tmp_name'], $folder . $nama);
    echo "Upload berhasil: " . htmlspecialchars($nama);
} elseif ($kode === UPLOAD_ERR_INI_SIZE) {
    echo "Upload gagal: ukuran file melebihi upload_max_filesize di php.ini.";
} elseif ($kode === UPLOAD_ERR_NO_FILE) {
    echo "Upload gagal: belum ada file yang dipilih.";
} else {
    echo "Upload gagal, kode error: " . $kode;
}
?>
