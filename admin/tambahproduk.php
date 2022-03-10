 <?php

    $data = mysqli_query($conn, "SELECT * FROM kategori");

    if (isset($_POST['save'])) {
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];

        //gambar
        $nama_files = $_FILES['foto']['name']; //isinya array foto
        $tipe_file = $_FILES['foto']['type'];
        $ukuran_file = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmp_files = $_FILES['foto']['tmp_name']; //isinya array lokasi
        move_uploaded_file($tmp_files[0], 'image/' . $nama_files[0]);

        mysqli_query($conn, "INSERT INTO produk VALUES('null','$kategori','$nama','$harga','$berat','$nama_files[0]','$deskripsi','$stok')");
        echo mysqli_error($conn);

        //DAPATKAN id barusan
        $idbarusan = mysqli_insert_id($conn);
        //masukkan ke database semua
        foreach ($nama_files as $nf => $tiapnama) {
            $tiap_lokasi = $tmp_files[$nf];

            move_uploaded_file($tiap_lokasi, "image/" . $tiapnama);

            mysqli_query($conn, "INSERT INTO foto VALUES ('null','$idbarusan','$tiapnama')");
        }

        //notif    
        echo '<div class="alert alert-info">Berhasil Ditambahkan</div>';
        echo '<meta http-equiv="refresh" content="1,url=index.php?halaman=produk">';
    };


    echo "<pre>";
    print_r($nama_file);
    echo "</pre>";


    ?>


 <div class="col-md-6">
     <h3>Tambah Data Produk</h3> <br>
     <form method="POST" enctype="multipart/form-data">
         <div class="form-group">
             <label>Nama Produk</label>
             <input class="form-control" type="text" name="nama" autofocus>
         </div>
         <div class="form-group">
             <label>Kategori</label>
             <select name="kategori" class="form-control">
                 <?php while ($a = mysqli_fetch_assoc($data)) : ?>
                     <option value="<?= $a['id_kategori']; ?>"><?= $a['nama_kategori']; ?></option>
                 <?php endwhile; ?>
             </select>
         </div>
         <div class="form-group">
             <label>Harga Rp.</label>
             <input class="form-control" type="text" name="harga">
         </div>
         <div class="form-group">
             <label>Berat Gr</label>
             <input class="form-control" type="text" name="berat">
         </div>
         <div class="form-group">
             <label>Deskripsi</label>
             <input class="form-control" type="textarea" name="deskripsi">
         </div>
         <div class="form-group">
             <label>Stok</label>
             <input class="form-control" type="number" name="stok" min="1">
         </div>
         <div class="form-group">
             <label>Foto</label>
             <div class="letak-input">
                 <input class="form-control" type="file" name="foto[]" style="margin-bottom: 5px;">
             </div>
             <span class="btn btn-info btn-tambah" style="margin-top: 10px;">
                 <i class="fa fa-plus"></i>
             </span>
         </div>
         <button type="submit" class="btn btn-primary" name="save" style="width: 30%">Save</button>
     </form>
 </div>

 <script>
     $(document).ready(function() {
         $(".btn-tambah").on("click", function() {
             $(".letak-input").append('<input class="form-control" type="file" name="foto[]" style="margin-bottom: 5px;">');
         })
     })
 </script>