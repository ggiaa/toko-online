<?php
$idproduk = $_GET['idproduk'];
$idfoto = $_GET['idfoto'];

$data = mysqli_query($conn, "SELECT * FROM foto WHERE id='$idfoto'");
$result = mysqli_fetch_assoc($data);

$namafoto = $result['nama_foto'];

//hapus foto dari folder
unlink('image/' . $namafoto);

mysqli_query($conn, "DELETE FROM foto WHERE id='$idfoto'");

echo "<script>alert('Foto Berhasil Dihapus')</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$idproduk'</script>";
