<?php
// SALAH: tanpa titik koma (;) dan "else ($a < 0)" kurang "if"
// Pesan: Parse error: syntax error, unexpected T_ELSE
$a = 5;
if ($a > 0) $status = "A lebih besar dari 0"
else ($a < 0) $status = "A lebih kecil dari 0"
else $status = "A sama dengan 0"
echo $status;
?>
