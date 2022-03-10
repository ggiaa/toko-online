<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk ='$id'");
$data = mysqli_fetch_assoc($produk);
// var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <title>Detail</title>
</head>

<body>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Detail</h4>
                </div>
                <div class="panel-body">
                    <section class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="admin/image/<?= $data['foto']; ?>" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-4">
                                    <h2><?= $data['nama']; ?></h2>
                                    <h5>Stok Barang : <?= $data['stok']; ?></h5>
                                    <h4>Rp. <?= number_format($data['harga']); ?></h4>
                                    <h4>berat : <?= $data['berat']; ?> gram </h4>
                                    <p><?= $data['deskripsi']; ?></p>
                                </div>
                                <div class="col-md-2">
                                    <form method="POST">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" name="jumlah" class="form-control" min="1" max="<?= $data['stok']; ?>">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" name="beli">Beli</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['beli'])) {
    $jumlah = $_POST['jumlah'];

    //masukkan ke session
    $_SESSION['keranjang'][$id] = $jumlah;

    echo "<script>alert('Berhasil ditambahkan ke keranjang');</script>";
    echo "<script>location='keranjang.php';</script>";
}
?>