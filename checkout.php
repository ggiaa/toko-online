<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    echo "
    <script>location='login.php'</script>
    ";
}
if (!isset($_SESSION['keranjang'])) {
    echo "
    <script>alert('Belum ada barang yang dibeli')</script>
    <script>location='index.php'</script>
    ";
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
</head>

<!-- navbar -->
<?php include 'navbar.php'; ?>

<!-- <pre>
    <?php print_r($_SESSION['user']) ?>
</pre> -->
<section>
    <div class="container">
        <h3>Checkout</h3>
        <hr>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <!-- total belanja -->
                <?php $totalbelanja = 0; ?>
                <!-- ambil id produk dan jumlah -->
                <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $data = mysqli_fetch_assoc($ambil);
                    $subtotal = $data['harga'] * $jumlah;
                    // echo "<pre>";
                    // print_r($data);
                    // echo "</pre>";
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['harga']; ?></td>
                        <td><?= $jumlah; ?></td>
                        <td><?= $subtotal; ?></td>
                    </tr>
                    <?php $totalbelanja += $subtotal; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"><strong>Total Belanja</strong></td>
                    <td>Rp. <?= number_format($totalbelanja); ?></td>
                </tr>
            </tbody>
        </table>
        <!-- ambil data dari tabel ongkir -->
        <?php
        $ongkir = mysqli_query($conn, "SELECT * FROM ongkir");

        ?>
        <form method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly class="form-control" value="<?= $_SESSION['user']['nama']; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly class="form-control" value="<?= $_SESSION['user']['telp']; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="id_ongkir" class="form-control">
                        <option value="">-- Pilih Ongkos Kirim --</option>
                        <?php while ($ongkirdata = mysqli_fetch_assoc($ongkir)) : ?>
                            <option value="<?= $ongkirdata['id_ongkir']; ?>">
                                <?= $ongkirdata['nama_kota'] ?> -
                                Rp. <?= number_format($ongkirdata['tarif']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat :</label>
                <textarea name="alamat" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary" name="checkout">Bayar</button>
        </form>
    </div>
</section>

<?php
if (isset($_POST['checkout'])) {
    $id_pelanggan = $_SESSION['user']['id_pelanggan'];
    $id_ongkir = $_POST['id_ongkir'];
    $tanggal_beli = date('Y-m-d');

    $ongkir = mysqli_query($conn, "SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
    $dataongkir = mysqli_fetch_assoc($ongkir);
    $tarif = $dataongkir['tarif'];
    $nama_kota = $dataongkir['nama_kota'];
    $alamat = $_POST['alamat'];

    $totalbayar = $totalbelanja + $tarif;

    mysqli_query($conn, "INSERT INTO pembelian VALUES('null','$id_pelanggan','$id_ongkir','$tanggal_beli','$totalbayar','$nama_kota','$tarif','$alamat','pending','null')");

    // masukkan ke tabel produk terjual

    // ambil id sekarang
    $id_terbaru = $conn->insert_id;

    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        //mendapatkan id_produk
        $pro = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
        $produkdata = mysqli_fetch_assoc($pro);
        $nama = $produkdata['nama'];
        $harga = $produkdata['harga'];
        $berat = $produkdata['berat'];
        $subberat = $berat * $jumlah;
        $subharga = $harga * $jumlah;

        mysqli_query($conn, "INSERT INTO produk_terjual VALUES('null','$id_terbaru','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga')");

        //kurangi stok
        mysqli_query($conn, "UPDATE produk SET stok = stok - $jumlah WHERE id_produk = '$id_produk'");

        // kosongkan keranjang
        unset($_SESSION['keranjang']);

        echo "<script>echo('Berhasil!')</script>";
        echo "<script>location='nota.php?id=$id_terbaru';</script>";
    }
}
?>

<pre>
   <?php print_r($_SESSION); ?>
</pre>