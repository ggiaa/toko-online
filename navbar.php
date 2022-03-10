<!-- navbar -->
<nav class="nav navbar-default">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a class="navbar-brand" href="index.php">Home</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <?php
            if (!isset($_SESSION['user'])) : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="daftar.php">Daftar</a></li>

            <?php else : ?>
                <li><a href="logout.php" onclick="return confirm('Yakin Logout?')">Logout</a></li>
                <li><a href="riwayat.php">Riwayat Belanja</a></li>
            <?php endif; ?>
            <li><a href="checkout.php">Checkout</a></li>

        </ul>
    </div>
</nav>