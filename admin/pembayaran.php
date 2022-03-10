<?php
$id = $_GET['id'];

//ambil foto
$data = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_pembelian = '$id'");
$dataresult = mysqli_fetch_assoc($data);

?>

<h2>Data Pembayaran</h2>
<hr>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?= $dataresult['nama']; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?= $dataresult['bank']; ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?= number_format($dataresult['jumlah']); ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= $dataresult['tanggal']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?= $dataresult['bukti']; ?>" width="450px">
    </div>
</div>
<hr>
<form method="POST">
    <div class="form-group">
        <label>No resi</label>
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">-- PILIH --</option>
            <option value="Lunas">Lunas</option>
            <option value="Barang Dikirim">Barang Dikirim</option>
            <option value="Batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST['proses'])) {
    $resi = $_POST['resi'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian = '$id'");

    echo "
    <script>
    alert('Berhasil Diproses!');
    document.location.href='index.php?halaman=pembelian';
    </script>";
}
?>