<?php

session_start();

include 'koneksi.php';

$id = $_GET['id'];


unset($_SESSION['keranjang'][$id]);

echo "
<script>location='keranjang.php'</script>
";
