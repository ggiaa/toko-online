<?php
session_start();

$id = $_GET['id'];

if (isset($_SESSION['keranjang'][$id])) {
    $_SESSION['keranjang'][$id] += 1;
} else {
    $_SESSION['keranjang'][$id] = 1;
}

echo "
<script>alert('Berhasil dimasukkan ke keranjang')</script>
<script>location='keranjang.php'</script>
";
