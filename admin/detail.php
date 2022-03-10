<?php
$id = $_GET['id'];

$details = mysqli_query($conn, "SELECT * FROM pelanggan JOIN pembelian 
ON pelanggan.id_pelanggan=pembelian.id_pelanggan WHERE pembelian.id_pembelian='$id'");

$detail = mysqli_fetch_assoc($details);

//tabel
$details2 = mysqli_query($conn, "SELECT * FROM produk JOIN produk_terjual ON produk.id_produk=produk_terjual.id_produk
WHERE produk_terjual.id_pembelian = '$id'");

?>
<!-- <?php
        echo "<pre>";
        print_r($detail);
        echo "</pre>"
        ?> -->
<h2>Detail Pembelian</h2>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <table class="table">
            <tr>
                <td>Tanggal</td>
                <td><?= $detail['tanggal']; ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>Rp. <?= number_format($detail['total']); ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?= $detail['status_pembelian']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td><?= $detail['nama']; ?></td>
            </tr>
            <tr>
                <td>No Telp</td>
                <td><?= $detail['telp']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $detail['email']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <table class="table">
            <tr>
                <td>Tujuan</td>
                <td><?= $detail['nama_kota']; ?></td>
            </tr>
            <tr>
                <td>Ongkos Kirim</td>
                <td>Rp. <?= number_format($detail['tarif']); ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $detail['alamat']; ?></td>
            </tr>
        </table>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>
    <?php $no = 1 ?>
    <?php while ($detail2 = mysqli_fetch_assoc($details2)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $detail2['nama']; ?></td>
            <td>Rp. <?= number_format($detail2['harga']); ?></td>
            <td><?= $detail2['jumlah']; ?></td>
            <td>Rp. <?= number_format($detail2['harga'] * $detail2['jumlah']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>