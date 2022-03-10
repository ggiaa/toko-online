<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];

$details = mysqli_query($conn, "SELECT * FROM pelanggan JOIN pembelian 
ON pelanggan.id_pelanggan=pembelian.id_pelanggan WHERE pembelian.id_pembelian='$id'");

$detail = mysqli_fetch_assoc($details);

//tabel
$details2 = mysqli_query($conn, "SELECT * FROM produk JOIN produk_terjual ON produk.id_produk=produk_terjual.id_produk
WHERE produk_terjual.id_pembelian = '$id'");

$ongkir = mysqli_query($conn, "SELECT * FROM pembelian WHERE pembelian.id_pembelian = '$id'");
$tarif = mysqli_fetch_assoc($ongkir);


//pengamanan nota
//jika id yang login
$id_pelangganlogin = $_SESSION['user']['id_pelanggan'];
$id_pelangganbeli = $detail['id_pelanggan'];

if ($id_pelangganlogin !== $id_pelangganbeli) {
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
    <title>Document</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <!-- <pre>
        <?php print_r($_SESSION); ?>
        <?php print_r($detail); ?>
        <?php print_r($detail['id_pelanggan']); ?>
    </pre> -->

    <section class="conten">
        <div class="container">
            <!-- <pre><?php print_r($detail); ?></pre> -->
            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <hr>
                    <p>ID Pembelian : <?= $detail['id_pembelian']; ?></p>
                    <p>Tanggal : <?= $detail['tanggal']; ?></p>
                    <p>Total : Rp. <?= number_format($detail['total']); ?></p>
                </div>
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                    <hr>
                    <P>Nama : <?= $detail['nama']; ?></P>
                    <P>Telp : <?= $detail['telp']; ?></P>
                    <P>Email : <?= $detail['email']; ?></P>
                </div>
                <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <hr>
                    <P><?= $detail['nama_kota']; ?></P>
                    <P>Ongkos Kirim : Rp. <?= number_format($detail['tarif']); ?></P>
                    <P>Alamat : <?= $detail['alamat']; ?></P>
                </div>
            </div>
            <hr>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                <?php $no = 1 ?>
                <?php $totalsemua = 0; ?>
                <?php while ($detail2 = mysqli_fetch_assoc($details2)) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $detail2['nama']; ?></td>
                        <td>Rp. <?= number_format($detail2['harga']); ?></td>
                        <td><?= $detail2['jumlah']; ?></td>
                        <td>Rp. <?= number_format($detail2['harga'] * $detail2['jumlah']); ?></td>
                    </tr>
                    <?php $totalsemua += ($detail2['harga'] * $detail2['jumlah']) ?>
                <?php endwhile; ?>
                <tr>
                    <td colspan="4"><strong>Ongkos Kirim</strong></td>
                    <td>Rp. <?= number_format($tarif['tarif']); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>TOTAL</strong></td>
                    <td><strong>Rp. <?= number_format($totalsemua += $tarif['tarif']); ?></strong></td>
                </tr>
            </table>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="alert alert-info">
                    <p>Silahkan melakukan pembayaran Rp. <?= number_format($detail['total']) ?> ke<br>
                        <strong>BANK MANDIRI 137-29394-232424 AN Doe</strong>
                    </p>

                </div>
            </div>
        </div>
    </div>
</body>

</html>