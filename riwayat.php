<?php include 'koneksi.php';
session_start();

if (!isset($_SESSION['user']) or empty($_SESSION['user'])) {
    echo "<script>location='index.php'</script>";
}

//ambil id_pelanggan dari session
$id = $_SESSION['user']['id_pelanggan'];

//query
$data = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_pelanggan='$id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <title>Riwayat</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <!-- <pre>
        <?php print_r($_SESSION); ?>
    </pre> -->

    <section class="content">
        <div class="container">
            <div class="row">
                <h3>Riwayat Belanja</h3>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($result = mysqli_fetch_assoc($data)) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $result['tanggal']; ?></td>
                                <td>
                                    <?= $result['status_pembelian']; ?>
                                    <?php if ($result['status_pembelian'] == 'Barang Dikirim') : ?>
                                        <p>No Resi : <strong><?= $result['resi_pengiriman']; ?></strong></p>
                                    <?php endif; ?>
                                </td>
                                <td>Rp. <?= number_format($result['total']); ?></td>
                                <td>
                                    <a href="nota.php?id=<?= $result['id_pembelian']; ?>" class="btn btn-info">Nota</a>
                                    <?php $result['status_pembelian']; ?>
                                    <?php if ($result['status_pembelian'] == 'pending') : ?>
                                        <a href="pembayaran.php?id=<?= $result['id_pembelian']; ?>" class="btn btn-primary">Bayar</a>
                                    <?php else : ?>
                                        <a href="lihat_pembayaran.php?id=<?= $result['id_pembelian']; ?>" class="btn btn-warning">Lihat Pembayaran</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>