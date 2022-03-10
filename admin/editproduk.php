<?php

$id = $_GET['id'];
$ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");
$ambilkat = mysqli_query($conn, "SELECT * FROM kategori");


$data = mysqli_fetch_assoc($ambil);

if (isset($_POST['ubah'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];

    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $berat = $_POST['berat'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($lokasi)) {
        move_uploaded_file($lokasi, 'image/' . $namafoto);

        mysqli_query($conn, "UPDATE produk set id_kategori = '$kategori', nama ='$nama', harga ='$harga', berat ='$berat', foto ='$namafoto', deskripsi ='$deskripsi', stok = '$stok'
        WHERE id_produk ='$id'");

        unlink('image/' . $_POST['gambar_lama']);
    } else {
        mysqli_query($conn, "UPDATE produk set id_kategori = '$kategori', nama ='$nama', harga ='$harga', berat ='$berat', deskripsi ='$deskripsi', stok = '$stok'
        WHERE id_produk ='$id'");
    }

    echo "
    <script>
    alert('Berhasil Di ubah');
    document.location.href='index.php?halaman=produk';
    </script>
    ";
}

?>

<div class="col-md-6">
    <h3>Ubah Data Produk</h3><br>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk</label>
            <input class="form-control" type="text" name="nama" value="<?= $data['nama']; ?>">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
                <?php while ($a = mysqli_fetch_assoc($ambilkat)) : ?>
                    <option value="<?= $a['id_kategori']; ?>" <?php if ($data['id_kategori'] == $a['id_kategori']) {
                                                                    echo "selected";
                                                                } ?>><?= $a['nama_kategori']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Harga Rp.</label>
            <input class="form-control" type="text" name="harga" value="<?= $data['harga']; ?>">
        </div>
        <div class="form-group">
            <label>Berat Gr</label>
            <input class="form-control" type="text" name="berat" value="<?= $data['berat']; ?>">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input class="form-control" type="textarea" name="deskripsi" value="<?= $data['deskripsi']; ?>">
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input class="form-control" type="number" name="stok" min="1" value="<?= $data['stok']; ?>">
        </div>
        <div class="form-group">
            <!-- gambar lama -->
            <input type="hidden" name="gambar_lama" value="<?= $data['foto']; ?>">
        </div>
        <div class="form-group">
            <label>Foto : </label>
            <img src="image/<?= $data['foto']; ?>" width="80" style="display: block;">
        </div>
        <div class="form-group">
            <label>Ganti Foto</label>
            <input class="form-control" type="file" name="foto" onchange="previewImage()">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 30%;" name="ubah">Ubah</button>
    </form>
</div>