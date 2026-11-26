<?php
// SALAH: batas waktu hanya 2 detik, sedangkan proses berjalan lebih lama
// Pesan: Fatal error: Maximum execution time of 2 seconds exceeded
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 2);

echo "Proses dimulai...<br>";
$mulai = time();
while (time() - $mulai < 10) {
    // perulangan sibuk selama 10 detik
}
echo "Proses selesai";
?>
