<?php include 'koneksi.php';
session_start();

if (!isset($_SESSION['user']) or empty($_SESSION['user'])) {
    echo "<script>location='index.php'</script>";
}

//mengamankan data
$idpem = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_pembelian ='$idpem'");
$det = mysqli_fetch_assoc($data);

$id_login = $_SESSION['user']['id_pelanggan'];
$id_beli = $det['id_pelanggan'];

if ($id_login !== $id_beli) {
    echo "<script>location='index.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <title>pembayaran</title>
</head>

<body>
    <!-- <pre>
    <?php print_r($_SESSION); ?>
    <?php print_r($det); ?>
    </pre> -->

    <?php include 'navbar.php'; ?>

    <section>
        <form method="POST" enctype="multipart/form-data">
            <div class="container">
                <h3>Konfirmasi Pembayaran</h3>
                <div class="form-group">
                    <p class="alert alert-info">Total tagihan anda adalah <strong>Rp. <?= number_format($det['total']); ?></strong></p>
                </div>
                <div class="form-group">
                    <label> Nama Penyetor</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label> Bank</label>
                    <input type="text" name="bank" class="form-control">
                </div>
                <div class="form-group">
                    <label> jumlah</label>
                    <input type="number" name="jumlah" class="form-control" min="1">
                </div>
                <div class="form-group">
                    <label> Bukti Pembayaran</label>
                    <input type="file" name="bukti" class="form-control">
                    <p class="text-danger">Bukti harus berupa gambar (maks 2Mb)</p>
                </div>
                <div class="form-group">
                    <button name="kirim" class="btn btn-primary">Konfirmasi</button>
                </div>
            </div>
        </form>
    </section>
</body>

</html>

<?php

if (isset($_POST['kirim'])) {

    //gambar
    $nama = $_FILES['bukti']['name'];
    $lokasi = $_FILES['bukti']['tmp_name'];
    $namaunik = date("YmdHis") . $nama;
    move_uploaded_file($lokasi, "bukti_pembayaran/$namaunik");

    $nama_penyetor = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date("Y-m-d");

    mysqli_query($conn, "INSERT INTO pembayaran VALUES ('null','$idpem','$nama_penyetor','$bank','$jumlah','$tanggal','$namaunik')");

    //update status pembayaran
    mysqli_query($conn, "UPDATE pembelian SET status_pembelian = 'Sudah Kirim Bukti' WHERE id_pembelian = '$idpem'");

    echo "
    <script>alert('Terima kasih telah melakukan pembayaran! Pesanan Anda akan segera diproses')</script>
    <script>location='riwayat.php'</script>
    ";
}

?>