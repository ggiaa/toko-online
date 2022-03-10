<?php

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    mysqli_query($conn, "INSERT INTO pelanggan VALUES('null','$email','$password','$nama','$telp')");

    echo '<div class="alert alert-info">Berhasil Disimpan</div>';
    echo '<meta http-equiv="refresh" content="1,index.php?halaman=pelanggan">';
}
?>


<div class="col-md-6">
    <h3>Tambah Data Pelanggan</h3>
    <form method="POST">
        <div class="form-group">
            <label>Nama</label>
            <input class="form-control" type="text" name="nama" autofocus>
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="text" name="email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="text" name="password">
        </div>
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input class="form-control" type="number" name="telp">
        </div>
        <button type="submit" name="simpan" class="btn btn-primary" style="width: 30%;">Save</button>
    </form>
</div>