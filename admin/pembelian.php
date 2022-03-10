<?php
$produks = mysqli_query($conn, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
?>

<h2>Data Pembelian</h2>
<br>
<div class="col-md-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php while ($produk = mysqli_fetch_assoc($produks)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $produk['nama']; ?></td>
                    <td><?= $produk['tanggal']; ?></td>
                    <td><?= $produk['total']; ?></td>
                    <td><?= $produk['status_pembelian']; ?></td>
                    <td>
                        <a href="index.php?halaman=detail&id=<?= $produk['id_pembelian']; ?>" class="btn btn-info">Detail</a>
                        <?php if ($produk['status_pembelian'] !== 'pending') : ?>
                            <a href="index.php?halaman=pembayaran&id=<?= $produk['id_pembelian']; ?>" class="btn btn-success">Pembayaran</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>