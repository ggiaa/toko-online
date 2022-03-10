<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'toko_online');

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $data = mysqli_query($conn, "SELECT * FROM admin where username='$user' AND password='$pass'");

    $hasil = mysqli_num_rows($data);
    if ($hasil == 1) {

        $_SESSION['admin'] = $data->fetch_assoc();
        echo "
        <script>
        alert('Berhasil Login');
        document.location.href='index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Gagal Login');
        document.location.href='login.php'; 
        </script>
        ";
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet">
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>
<div class="col-md-4">
    <h3>Sign In</h3><br>
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="user">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="pass">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 30%;" name="login">Sign In</button>
    </form>
</div>