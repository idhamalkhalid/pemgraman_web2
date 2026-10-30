<?php
// ===== KONEKSI DATABASE (XAMPP default) =====
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", "", "uts_php");

$pesan = "";
$error = "";

// Pesan setelah redirect (agar refresh tidak menyimpan data dobel)
if (isset($_GET['status'])) {
    if ($_GET['status'] == "ok") {
        $pesan = "Data berhasil disimpan. Klik tombol <b>Tampilkan Data</b> untuk melihat hasilnya.";
    } elseif ($_GET['status'] == "reset") {
        $pesan = "Semua data telah dihapus.";
    }
}

// ===== PROSES SIMPAN =====
if (isset($_POST['simpan'])) {

    $kode = strtoupper(trim($_POST['kode']));

    $stmt = $conn->prepare(
        "INSERT INTO pendaftar
        (tgl_input, kode, nama, jk, asal_sekolah, pekerjaan_ortu, tempat_lahir, tgl_lahir, mat, bing, umum)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $mat  = (float) $_POST['mat'];
    $bing = (float) $_POST['bing'];
    $umum = (float) $_POST['umum'];

    $stmt->bind_param(
        "ssssssssddd",
        $_POST['tgl_input'],
        $kode,
        $_POST['nama'],
        $_POST['jk'],
        $_POST['asal_sekolah'],
        $_POST['pekerjaan_ortu'],
        $_POST['tempat_lahir'],
        $_POST['tgl_lahir'],
        $mat,
        $bing,
        $umum
    );

    try {
        $stmt->execute();
        header("Location: index.php?status=ok");
        exit;
    } catch (mysqli_sql_exception $e) {
        $error = "Gagal menyimpan: " . htmlspecialchars($e->getMessage());
    }
}

// // ===== PROSES HAPUS SEMUA DATA =====
// if (isset($_POST['reset'])) {
//     $conn->query("TRUNCATE TABLE pendaftar");
//     header("Location: index.php?status=reset");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS PHP - Pendaftaran Mahasiswa</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;
            background: #f4f4f4;
        }

        .container{
            width: 100%;
            max-width: 900px;
            box-sizing: border-box;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align: center;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td{
            border: 1px solid black;
        }

        th, td{
            padding: 10px;
            text-align: center;
        }

        /* Tabel responsive: bisa digeser ke samping di layar kecil */
        .table-responsive{
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive table{
            min-width: 800px;
        }

        input[type=text],
        input[type=number],
        input[type=date]{
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn{
            background: blue;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:hover{ background: darkblue; }

        .btn-tampil{ background: green; }
        .btn-tampil:hover{ background: darkgreen; }

        .btn-reset{ background: crimson; }
        .btn-reset:hover{ background: darkred; }

        .aksi{
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .aksi form{ margin: 0; }

        .info{
            margin-top: 20px;
            padding: 10px;
            background: #eef;
        }

        .sukses{
            margin-top: 15px;
            padding: 10px;
            background: #dff0d8;
            color: #3c763d;
            border: 1px solid #3c763d;
        }

        .gagal{
            margin-top: 15px;
            padding: 10px;
            background: #f2dede;
            color: #a94442;
            border: 1px solid #a94442;
        }

        /* Layar kecil (HP) */
        @media (max-width: 600px){
            body{ margin: 10px; }
            .container{ padding: 12px; }
            .aksi{ flex-wrap: wrap; }
        }
    </style>
</head>
<body>

<div class="container">

    <h2>FORM PENDAFTARAN MAHASISWA BARU</h2>

    <form method="POST">

        <label>Tanggal Input</label>
        <input type="date" name="tgl_input" required>

        <label>Kode Pendaftaran</label>
        <input type="text" name="kode" placeholder="Contoh : A2" required>

        <label>Nama Pendaftar</label>
        <input type="text" name="nama" required>

        <label>Jenis Kelamin</label><br>
        <input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki
        <input type="radio" name="jk" value="Perempuan"> Perempuan
        <br><br>

        <label>Asal Sekolah</label>
        <input type="text" name="asal_sekolah" required>

        <label>Pekerjaan Orang Tua</label>
        <input type="text" name="pekerjaan_ortu" required>

        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" required>

        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" required>

        <label>Matematika</label>
        <input type="number" name="mat" required>

        <label>Bahasa Inggris</label>
        <input type="number" name="bing" required>

        <label>Umum</label>
        <input type="number" name="umum" required>

        <button type="submit" name="simpan" class="btn">SIMPAN</button>

    </form>

    <!-- Form terpisah agar tidak kena validasi 'required' -->
    <div class="aksi">
        <form method="POST">
            <button type="submit" name="tampil" class="btn btn-tampil">TAMPILKAN DATA</button>
        </form>
        <!-- <form method="POST" onsubmit="return confirm('Hapus semua data di database?');">
            <button type="submit" name="reset" class="btn btn-reset">HAPUS SEMUA DATA</button>
        </form> -->
    </div>

    <?php if ($pesan != ""): ?>
        <div class="sukses"><?= $pesan ?></div>
    <?php endif; ?>

    <?php if ($error != ""): ?>
        <div class="gagal"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($_POST['tampil'])): ?>

        <?php
        $result = $conn->query("SELECT * FROM pendaftar ORDER BY id ASC");
        ?>

        <?php if ($result->num_rows == 0): ?>

            <div class="info">Belum ada data yang disimpan.</div>

        <?php else: ?>

            <?php
            $jumlah_pendaftar   = 0;
            $jumlah_lulus       = 0;
            $jumlah_tidak_lulus = 0;
            ?>

            <div class="table-responsive">
                <table>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Tgl Lahir</th>
                        <th>Asal Sekolah</th>
                        <th>Pekerjaan Ortu</th>
                        <th>Tempat Tes</th>
                        <th>MAT</th>
                        <th>B. Inggris</th>
                        <th>Umum</th>
                        <th>Rata-rata</th>
                        <th>Keterangan</th>
                    </tr>

                    <?php while ($d = $result->fetch_assoc()): ?>
                        <?php
                        // Hitung rata-rata
                        $rata = ($d['mat'] + $d['bing'] + $d['umum']) / 3;

                        // Menentukan keterangan
                        if ($rata >= 70) {
                            $keterangan = "Lulus";
                        } elseif ($rata >= 60) {
                            $keterangan = "Cadangan";
                        } else {
                            $keterangan = "Tidak Lulus";
                        }

                        // Menentukan tempat tes berdasarkan kode
                        $kode_awal = substr($d['kode'], 0, 1);

                        if ($kode_awal == "A") {
                            $tempat_tes = "Gedung A";
                        } elseif ($kode_awal == "B") {
                            $tempat_tes = "Gedung B";
                        } elseif ($kode_awal == "V") {
                            $tempat_tes = "Viktor";
                        } else {
                            $tempat_tes = "Tidak Diketahui";
                        }

                        // Rekap
                        $jumlah_pendaftar++;
                        if ($keterangan == "Lulus") {
                            $jumlah_lulus++;
                        } else {
                            $jumlah_tidak_lulus++;
                        }
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($d['kode']) ?></td>
                            <td><?= htmlspecialchars($d['nama']) ?></td>
                            <td><?= htmlspecialchars($d['jk']) ?></td>
                            <td><?= htmlspecialchars($d['tempat_lahir']) ?>, <?= htmlspecialchars($d['tgl_lahir']) ?></td>
                            <td><?= htmlspecialchars($d['asal_sekolah']) ?></td>
                            <td><?= htmlspecialchars($d['pekerjaan_ortu']) ?></td>
                            <td><?= $tempat_tes ?></td>
                            <td><?= (float) $d['mat'] ?></td>
                            <td><?= (float) $d['bing'] ?></td>
                            <td><?= (float) $d['umum'] ?></td>
                            <td><?= number_format($rata, 2) ?></td>
                            <td><?= $keterangan ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <div class="info">
                <h3>Rekap Data:</h3>
                <p>Jumlah Pendaftar : <b><?= $jumlah_pendaftar ?></b></p>
                <p>Jumlah Peserta Lulus : <b><?= $jumlah_lulus ?></b></p>
                <p>Jumlah Tidak Lulus : <b><?= $jumlah_tidak_lulus ?></b></p>
            </div>

            <div class="info">
                <h3>Keterangan:</h3>
                <p><b>Kode Tempat Tes:</b></p>
                <ul>
                    <li>A = Gedung A</li>
                    <li>B = Gedung B</li>
                    <li>V = Viktor</li>
                </ul>

                <p><b>Hasil Seleksi:</b></p>
                <ul>
                    <li>Rata-rata ≥ 70 = Lulus</li>
                    <li>Rata-rata 60 - 69 = Cadangan</li>
                    <li>Rata-rata &lt; 60 = Tidak Lulus</li>
                </ul>
            </div>

        <?php endif; ?>

    <?php endif; ?>

</div>

</body>
</html>