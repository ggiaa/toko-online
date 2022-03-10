<?php
//data produk
$idproduk = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk = '$idproduk'");
$produkdata = mysqli_fetch_assoc($produk);

//data gambar
$foto = mysqli_query($conn, "SELECT * FROM foto WHERE id_produk='$idproduk'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Detail Produk</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <td><?= $produkdata['nama_kategori']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td><?= $produkdata['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td><?= $produkdata['harga']; ?></td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td><?= $produkdata['berat']; ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td><?= $produkdata['deskripsi']; ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td><?= $produkdata['stok']; ?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <form method="POST" enctype="multipart/form-data">
                    <div class="col-md-2">
                        <label>Tambah Foto</label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" name="fotoproduk" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" name="tambah">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <?php while ($datafoto = mysqli_fetch_assoc($foto)) : ?>
            <div class="col-md-3 text-center">
                <img src="image/<?= $datafoto['nama_foto']; ?>" alt="" class="img-responsive"><br>
                <a class="btn btn-danger" href="index.php?halaman=hapusfoto&idproduk=<?= $idproduk; ?>&idfoto=<?= $datafoto['id']; ?>">Hapus</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>

<?php
if (isset($_POST['tambah'])) {
    $nama = $_FILES['fotoproduk']['name']; //isinya array foto
    $lokasi = $_FILES['fotoproduk']['tmp_name'];

    $namafoto = date('YmdHis') . $nama;

    //masukkan folder
    move_uploaded_file($lokasi, 'image/' . $namafoto);

    mysqli_query($conn, "INSERT INTO foto VALUES ('null','$idproduk','$namafoto') ");

    echo "<script>alert('Berhasil Ditambah')</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$idproduk'</script>";
}
?>