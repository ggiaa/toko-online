<?php
include 'koneksi.php';

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet">
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>

<!-- navbar -->
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="col-md-4">
        <h3>Login</h3><br>
        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="pass">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 30%;" name="login">Login</button>
        </form>
    </div>
</div>

<?php

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $ambil = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email = '$email' AND password = '$pass'");

    $result = mysqli_num_rows($ambil);
    // var_dump($data);
    // die();

    if ($result == 1) {
        $data = mysqli_fetch_assoc($ambil);
        session_start();
        $_SESSION['user'] = $data;

        if (isset($_SESSION['keranjang']) or !empty($_SESSION['keranjang'])) {
            echo "<script>alert('Berhasil Login')</script>";
            echo "<script>location='keranjang.php'</script>";
        } else {
            echo "<script>alert('Berhasil Login')</script>";
            echo "<script>location='index.php'</script>";
        }
    } else {
        echo "<script>alert('Gagal Login')</script>";
        echo "<script>location='login.php'</script>";
    }
}

?>