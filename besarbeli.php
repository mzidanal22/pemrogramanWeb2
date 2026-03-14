<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Diskon Pembelian</title>
</head>
<body>

<form method="GET">
    Besar Pembelian :
    <input type="text" name="total_beli"><br>
    <input type="submit" value="Tentukan Diskon">
</form>

<?php
if(isset($_GET['total_beli'])) {

    $total_beli = intval($_GET['total_beli']);
    $diskon = 0;

    if($total_beli >= 200000){
        $diskon = 0.1;
    } 
    elseif($total_beli >= 100000){
        $diskon = 0.05;
    } 
    else{
        $diskon = 0.01;
    }

    $jumlah_diskon = $total_beli * $diskon;
    $bayar = $total_beli - $jumlah_diskon;

    echo "Diskon = " . ($diskon * 100) . "% <br>";
    echo "Total Bayar = " . $bayar;
}
?>

</body>
</html>