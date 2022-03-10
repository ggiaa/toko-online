<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <title>Daftar</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="text-align: center;"><strong>Daftar</strong></h2>
                    </div>
                    <div class="panel-body">
                        <form method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="pass">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nomor Telepon/HP</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="telp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea name="alamat" class="form-control" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // jika email sudah digunakan
    $data = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email='$email'");

    //hitung ada atau tidak
    $result = $data->num_rows;

    if ($result == 1) {
        echo "<script>alert('Gagal mendaftar! Email sudah digunakan!')</script>";
        echo "<script>location='daftar.php'</script>";
    } else {
        mysqli_query($conn, "INSERT INTO pelanggan VALUES('null','$email','$pass','$nama','$telp','$alamat')");
        echo "<script>alert('Berhasil mendaftar! Silahkan Login')</script>";
        echo "<script>location='login.php'</script>";
    }
}
?>