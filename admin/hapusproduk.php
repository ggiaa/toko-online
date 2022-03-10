<?php

$id = $_GET['id'];

//ambil semua data
$get = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");

//hapus foto
$ambil = $get->fetch_assoc();
$foto = $ambil['foto'];

if (file_exists('image/' . $foto)) {
    unlink('image/' . $foto);
}

mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");

echo "
<script>
alert('Berhasil Dihapus');
document.location.href='index.php?halaman=produk';
</script>
";
