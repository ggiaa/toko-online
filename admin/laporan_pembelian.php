<?php

if (isset($_POST['lihat'])) {
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

    $data = mysqli_query($conn, "SELECT * FROM pembelian pem LEFT JOIN pelanggan pel ON pem.id_pelanggan = pel.id_pelanggan WHERE tanggal BETWEEN '$mulai' AND '$selesai'");

    while ($result = mysqli_fetch_assoc($data)) {
        $semuadata[] = $result;
    }

    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";
}
?>

<h2>Laporan Pembelian</h2>
<hr>

<div class="container">
    <form method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tanggal Mulai :</label>
                    <input type="date" class="form-control" name="mulai" value="<?= $mulai; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sampai Tanggal :</label>
                    <input type="date" class="form-control" name="selesai" value="<?= $selesai; ?>">
                </div>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label><br>
                <button class="btn btn-primary" name="lihat" style="width: 70%;">Lihat</button>
            </div>
        </div>
    </form>
    <hr>
</div>
<?php if (empty($semuadata)) : ?>
    <h3 style="text-align: center;">Laporan pembelian</h3><br>
<?php else : ?>
    <h3 style="text-align: center;">Laporan pembelian dari tanggal <?= $mulai; ?> Sampai tanggal <?= $selesai; ?></h3><br>
<?php endif; ?>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($semuadata)) : ?>
            <tr>
                <td colspan="5" style="font-style: italic; text-align:center;">
                    <h4>masukkan tanggal</h4>
                </td>
            </tr>
        <?php else : ?>
            <?php $no = 1;
            $totalbel = 0;
            foreach ($semuadata as $sm) : ?>
                <?php $totalbel += $sm['total'] ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $sm['nama']; ?></td>
                    <td><?= $sm['tanggal']; ?></td>
                    <td>Rp. <?= number_format($sm['total']); ?></td>
                    <td><?= $sm['status_pembelian']; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr style="font-style:oblique;">
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rp. <?= number_format($totalbel); ?></strong></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>