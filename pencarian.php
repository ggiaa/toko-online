<?php include 'koneksi.php';
$keyword = $_GET['keyword'];

$result = [];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'");
while ($hasil = mysqli_fetch_assoc($data)) {
    $result[] = $hasil;
}

// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <title>Pencarian</title>
</head>

<body>
    <nav class="nav navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="index.php">Home</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                <?php
                if (!isset($_SESSION['user'])) : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="daftar.php">Daftar</a></li>

                <?php else : ?>
                    <li><a href="logout.php" onclick="return confirm('Yakin Logout?')">Logout</a></li>
                    <li><a href="riwayat.php">Riwayat Belanja</a></li>
                <?php endif; ?>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
            <form action="pencarian.php" method="GET" class="navbar-form navbar-right">
                <input type="text" class="form-control" name="keyword" value="<?= $keyword; ?>">
                <button class="btn btn-primary">Cari</button>
            </form>
        </div>
    </nav>

    <!-- konten -->
    <section class="conten">
        <div class="container">
            <h3>Hasil pencarian untuk : <?= $keyword; ?></h3>
            <hr>

            <?php if (empty($result)) : ?>
                <div class="alert alert-danger">
                    <h5>Hasil pencarian untuk <strong><?= $keyword; ?></strong> tidak ditemukan.</h5>
                </div>
            <?php else : ?>
            <?php endif; ?>

            <div class="row">
                <?php foreach ($result as $value) : ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="admin/image/<?= $value['foto']; ?>">
                            <div class="caption">
                                <h3><?= $value['nama']; ?></h3>
                                <h5>Rp. <?= number_format($value['harga']); ?></h5>
                                <a href="beli.php?id=<?= $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
                                <a href="detail.php?id=<?= $value['id_produk']; ?>" class="btn btn-info">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</body>

</html>