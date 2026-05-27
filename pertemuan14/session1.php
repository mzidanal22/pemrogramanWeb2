<?php
/****************************************************
Halaman contoh pembuatan session.
session_start() harus diletakkan paling atas
sebelum output apa pun.
*****************************************************/

session_start();

$error = "";

if (isset($_POST['Login'])) {

    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);

    // Periksa login
    if ($user == "rahadian" && $pass == "123") {

        // Membuat session
        $_SESSION['login'] = $user;

        // Pindah ke halaman berikutnya
        header("Location: session2.php");
        exit();

    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Here...</title>
</head>
<body>

    <h2>Login Here...</h2>

    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form action="" method="post">

        Username :
        <input type="text" name="user" required>
        <br><br>

        Password :
        <input type="password" name="pass" required>
        <br><br>

        <input type="submit" name="Login" value="Log In">

    </form>

</body>
</html>