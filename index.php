<?php
session_start();
include 'koneksi.php';

$produks = mysqli_query($conn, "SELECT * FROM produk");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko</title>
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <script src="admin/assets/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
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
                <input type="text" class="form-control" name="keyword">
                <button class="btn btn-primary">Cari</button>
            </form>
        </div>
    </nav>

    <!-- konten -->
    <section class="conten">
        <div class="container">
            <h2>Produk terbaru</h2>
            <hr>

            <div class="row">
                <?php while ($data = mysqli_fetch_assoc($produks)) : ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="admin/image/<?= $data['foto']; ?>">
                            <div class="caption">
                                <h3><?= $data['nama']; ?></h3>
                                <h5>Rp. <?= number_format($data['harga']); ?></h5>
                                <a href="beli.php?id=<?= $data['id_produk']; ?>" class="btn btn-primary">Beli</a>
                                <a href="detail.php?id=<?= $data['id_produk']; ?>" class="btn btn-info">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</body>

</html>