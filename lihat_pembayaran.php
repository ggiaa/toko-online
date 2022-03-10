<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembayaran.id_pembelian ='$id'");
$result = mysqli_fetch_assoc($data);
// echo "<pre>";
// print_r($result);
// print_r($_SESSION);
// echo "</pre>";

//mengamankan dari melihat pembayaran yang belum ada
if (empty($result)) {
    echo "<script>location='riwayat.php'</script>";
}
//mengamankan melihat pembayaran orang lain
$login = $_SESSION['user']['id_pelanggan'];
$lihat = $result['id_pelanggan'];
if ($login !== $lihat) {
    echo "<script>location='riwayat.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <title>Pembayaran</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container">
        <h3>Detail Pembayaran</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $result['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?= $result['bank']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. <?= number_format($result['jumlah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $result['tanggal']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="bukti_pembayaran/<?= $result['bukti']; ?>" alt="" width="450px" class="img-responsive">
            </div>
        </div>
    </div>
</body>

</html>