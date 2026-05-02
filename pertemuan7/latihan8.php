<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $var = array('18', '11', '2010');
        $tanggal = join("/", $var);
        echo "$tanggal";
    ?>
</body>
</html>