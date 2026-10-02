<html>
<head>
<title>Contoh Counter</title>
</head>
<body>
    <?php
        $nama_file="counter.dat";
        If (file_exists($nama_file))
        {
            $berkas = fopen($nama_file,"r");
            $pencacah = (int)trim(fgets($berkas, 255));
            $pencacah++;
            Fclose($berkas);
        }
        Else
        $pencacah = 1;
        $berkas = fopen($nama_file,"w");
        Fputs($berkas, $pencacah);
        Fclose($berkas);

        Print("Anda pengunjung ke-$pencacah <br>\n");   
    ?>
</body>
</html>
