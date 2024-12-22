<?php

include "./koneksi/config.php";
session_start();

if (!isset($_SESSION['id_users'])) {
    echo "<script>
                alert('Harap login dahulu');
                window.location.href = '../login.php';
            </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home DoToList | ITC Live Progamming</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <nav class="navbar-nav">
        <div class="logo">
            <a href="">ITC | DoToList</a>
        </div>
        <div class="nav-list" id="nav-list">
            <p onclick="closeNav()" id="timesNav"><span>&times;</span></p>
            <a class="nav-link" href="./">Home</a>
            <a class="nav-link" href="./src/kegiatan.php">Kegiatan</a>
            <p class="nav-link badge-name"><span><?= $_SESSION['username'] ?></span></p>
            <a class="btn-logout" href="./logout.php">Logout</a>
        </div>
        <div class="nav-responsive">
            <p onclick="openNav()" id="hamburger"><span>=</span></p>
        </div>
    </nav>
    <section class="home">
        <div class="container">
            <h1>Selamat datang, <span><?= $_SESSION['nama'] ?></span></h1>
            <h1>Di <span>DoToList</span> | ITC Live Progamming</h1>
        </div>
    </section>
    <section class="list-kegiatan">
        <?php
        $query = mysqli_query($conn, "SELECT tbl_kegiatan.*, tbl_users.nama FROM tbl_kegiatan
        INNER JOIN tbl_users ON tbl_kegiatan.id_users = tbl_users.id_users
        ORDER BY id_kegiatan DESC");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <div class="card">
                <div class="list">
                    <h3><?= $data['nama_kegiatan'] ?></h3>
                    <p class="tgl">Tanggal Kegiatan : <?= date("d F Y", strtotime($data['tgl_kegiatan'])) ?></p>
                    <p class="deskripsi"><?= $data['deskripsi'] ?></p>
                    <div class="foot">
                        <?php if ($data['status'] == 'belum') { ?>
                            <p class="status_belum"><?= $data['status'] = "Belum" ?></p>
                        <?php } else if ($data['status'] == 'terlaksana') { ?>
                            <p class="status_terlaksana"><?= $data['status'] = "Terlaksana" ?></p>
                        <?php } else if ($data['status'] == 'gagal') { ?>
                            <p class="status_gagal"><?= $data['status'] = "Gagal" ?></p>
                        <?php } ?>
                        <p><?= $data['nama'] ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <footer>
        <p>&copy; ITC Live Progamming By Bug Busters | <span>
                <script>
                    document.write(new Date().getFullYear())
                </script>
            </span></p>
    </footer>
    <script>
        const navList = document.getElementById("nav-list");

        function closeNav() {
            navList.style.right = "-100%";
        }

        function openNav() {
            navList.style.right = "0";
        }
    </script>
</body>

</html>