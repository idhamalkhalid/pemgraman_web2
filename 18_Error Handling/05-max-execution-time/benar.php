<?php
// BENAR: batas waktu dinaikkan (di php.ini: max_execution_time = 9999)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 30);

echo "Proses dimulai...<br>";
$mulai = time();
while (time() - $mulai < 5) {
    // perulangan sibuk selama 5 detik
}
echo "Proses selesai";
?>
