<?php
// BENAR: variabel didefinisikan dulu, dan parameter GET dicek dengan isset()
error_reporting(E_ALL);
ini_set('display_errors', 1);

$a = 10;
if ($a > 0) {
    echo "A lebih dari 0<br>";
}
if (isset($_GET['test']) && $_GET['test'] == 0) {
    echo "test sama dengan 0";
} else {
    echo "Parameter test belum diisi (coba: benar.php?test=0)";
}
?>
