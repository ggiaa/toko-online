<?php
$produks = mysqli_query($conn, "SELECT * FROM produk JOIN kategori WHERE produk.id_kategori=kategori.id_kategori");
?>

<h2>Data Produk</h2>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary" style="float: right;">Tambah Data</a>
<br>
<div class="col-md-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Berat (gr)</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php while ($data = $produk = mysqli_fetch_assoc($produks)) : ?>
                <?php
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['nama_kategori']; ?></td>
                    <td><?= $data['harga']; ?></td>
                    <td><?= $data['berat']; ?></td>
                    <td><img src="image/<?= $data['foto']; ?>" width="70"></td>
                    <td>
                        <a href="index.php?halaman=editproduk&id=<?= $data['id_produk']; ?>" class="btn btn-warning">Ubah</a>
                        <a href="index.php?halaman=detailproduk&id=<?= $data['id_produk']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapusproduk&id=<?= $data['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>