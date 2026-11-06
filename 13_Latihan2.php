<?php
//cek button -
if (isset($_POST['Submit']) && $_POST['Submit'] == "Submit") {
$id_mahasiswa = $_POST['id_mahasiswa'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];

//validasi data data kosong
if (empty($id_mahasiswa) || empty($nama) || empty($alamat) || empty($telepon)) {
?>
<script language="JavaScript">
alert('Data Harap Dilengkapi!');
document.location='13_Latihan1.php';
</script>
<?php
}
else {
include "13_koneksi-tutor.php";

//cek NIM di database
$stmt = mysqli_prepare($Open, "SELECT id_mahasiswa FROM mahasiswa WHERE id_mahasiswa = ?");
mysqli_stmt_bind_param($stmt, "s", $id_mahasiswa);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$cek = mysqli_stmt_num_rows($stmt);
mysqli_stmt_close($stmt);

if ($cek > 0) {
?>
<script language="JavaScript">
alert('NIM sudah dipakai!, silahkan ganti NIM yang lain');
document.location='download-script-form-input-data.php';
</script>
<?php
exit;
}

//Masukan data ke Table
$stmt = mysqli_prepare($Open, "INSERT INTO mahasiswa (id_mahasiswa,nama,jurusan,alamat,telepon) VALUES (?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, "sssss", $id_mahasiswa, $nama, $jurusan, $alamat, $telepon);
$query_input = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($query_input) {
//Jika Sukses
?>
<script language="JavaScript">
alert('Input Data Mahasiswa Berhasil');
document.location='download-script-form-input-data.php';
</script>
<?php
}
else {
//Jika Gagal
echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!";
}
//Tutup koneksi engine MySQL
mysqli_close($Open);
}
}
?>
