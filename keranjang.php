<?php
session_start();
include 'koneksi.php';

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

?>

<link href="admin/assets/css/bootstrap.css" rel="stylesheet">
<!-- navbar -->
<?php include 'navbar.php'; ?>
<br>
<div class="container">
    <h3>Keranjang</h3>
    <hr>
    <?php if (!empty($_SESSION['keranjang'])) : ?>
        <a href="checkout.php" class="btn btn-primary" style="float: right;">Checkout</a>
        <a href="index.php" class="btn btn-default" style="float: right;margin-right: 10px">Kembali</a><br></br></br>
    <?php else : ?>
        <a href="index.php" class="btn btn-default" style="float: right;margin-right: 10px">Kembali</a><br></br></br>
    <?php endif; ?>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php if (!empty($_SESSION['keranjang'])) : ?>

                <?php $no = 1 ?>
                <!-- ambil id produk dan jumlah -->
                <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $data = mysqli_fetch_assoc($ambil);
                    $subtotal = $data['harga'] * $jumlah;
                    // echo "<pre>";
                    // print_r($data);
                    // echo "</pre>";
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['harga']; ?></td>
                        <td><?= $jumlah; ?></td>
                        <td><?= $subtotal; ?></td>
                        <td>
                            <a href="hapuskeranjang.php?id=<?= $data['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Hapus dari keranjang?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" style="text-align: center;"><strong>Belum Ada Barang Di Keranjang</strong></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>