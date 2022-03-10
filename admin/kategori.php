<?php
$data = mysqli_query($conn, "SELECT * FROM kategori");

$semuadata = [];
while ($result = mysqli_fetch_assoc($data)) {
    $semuadata[] = $result;
}
?>

<div class="container">
    <div class="row">
        <h2>Kategori Produk</h2>
        <hr>
    </div>
    <div class="row">
        <a href="" class="btn btn-primary">Tambah Kategori</a>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($semuadata as $sm) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $sm['nama_kategori']; ?></td>
                        <td>
                            <a href="index.php?halaman=edit_kategori" class="btn btn-warning">Edit</a>
                            <a href="index.php?halaman=hapus_kategori" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>