<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana PHP</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { display: inline-block; text-align: left; }
        .label-group { margin-bottom: 5px; color: brown; font-weight: bold; }
        .input-group { display: flex; align-items: center; gap: 5px; }
        input[type="number"] { width: 150px; padding: 5px; border: 1px solid #ccc; }
        select { padding: 5px; border: 1px solid #ccc; }
        input[type="submit"] { padding: 5px 15px; cursor: pointer; }
        .hasil { margin-top: 20px; font-size: 1.2rem; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Buatlah tampilan dibawah ini</h2>

    <div class="container">
        <form method="POST">
            <div class="label-group">
                <span style="margin-left: 50px;">Nilai I</span>
                <span style="margin-left: 100px;">Nilai II</span>
            </div>
            
            <div class="input-group">
                <input type="number" name="nilai1" required value="<?php echo isset($_POST['nilai1']) ? $_POST['nilai1'] : ''; ?>">
                
                <select name="operator">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>

                <input type="number" name="nilai2" required value="<?php echo isset($_POST['nilai2']) ? $_POST['nilai2'] : ''; ?>">
                
                <input type="submit" name="hitung" value="submit">
            </div>
        </form>

        <?php
        if (isset($_POST['hitung'])) {
            $nilai1 = $_POST['nilai1'];
            $nilai2 = $_POST['nilai2'];
            $operator = $_POST['operator'];
            $hasil = 0;

            switch ($operator) {
                case '+':
                    $hasil = $nilai1 + $nilai2;
                    break;
                case '-':
                    $hasil = $nilai1 - $nilai2;
                    break;
                case '*':
                    $hasil = $nilai1 * $nilai2;
                    break;
                case '/':
                    // Validasi pembagian dengan nol
                    if ($nilai2 != 0) {
                        $hasil = $nilai1 / $nilai2;
                    } else {
                        $hasil = "Error (Tidak bisa bagi 0)";
                    }
                    break;
            }

            echo "<div class='hasil'>Hasil: $hasil</div>";
        }
        ?>
    </div>

</body>
</html>