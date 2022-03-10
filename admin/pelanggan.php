<?php
$produks = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<h2>Data Pelanggan</h2>
<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary" style="float: right;">Tambah Data</a>
<br>
<div class="col-md-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>No.Telp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php while ($produk = mysqli_fetch_assoc($produks)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $produk['nama']; ?></td>
                    <td><?= $produk['email']; ?></td>
                    <td><?= $produk['telp']; ?></td>
                    <td>
                        <a href="" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>