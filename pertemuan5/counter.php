<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Counter</title>
</head>
<body>
    <?php
        $nama_file="counter.dat";
        If (file_exists($nama_file)){
            $berkas = fopen($nama_file,"r");
            $pencacah = (integer)trim(fgets($berkas, 255));
            $pencacah++;Fclose($berkas);
            }
            else
                $pencacah = 1;
            // simpan pencacah
            $berkas = fopen($nama_file,"w");
            Fputs($berkas, $pencacah);
            Fclose($berkas);
        Print("Anda pengunjung ke-$pencacah <br>\n");
    ?>
</body>
</html>