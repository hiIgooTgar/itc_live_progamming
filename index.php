<?php

include "./koneksi/config.php";
session_start();

if (!isset($_SESSION['id_users'])) {
    echo "<script>
                alert('Harap login dahulu');
                window.location.href = './login.php';
            </script>";
}

$status_cari = isset($_GET['status']) ? $_GET['status'] : '0';

$where_kegiatan = "";
if ($status_cari !== '0') {
    $where_kegiatan = "WHERE tbl_kegiatan.status = '$status_cari'";
}

$query = mysqli_query($conn, "SELECT tbl_kegiatan.*, tbl_users.nama FROM tbl_kegiatan
        INNER JOIN tbl_users ON tbl_kegiatan.id_users = tbl_users.id_users
        $where_kegiatan
        ORDER BY id_kegiatan DESC");
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
    <div class="container search-col-heading">
        <h1>Daftar Kegiatan</h1>
        <form action="" method="get">
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="0" <?= ($status_cari == '0') ? 'selected' : '' ?>>All</option>
                <option value="belum" <?= ($status_cari == 'belum') ? 'selected' : '' ?>>Belum</option>
                <option value="terlaksana" <?= ($status_cari == 'terlaksana') ? 'selected' : '' ?>>Terlaksana</option>
                <option value="gagal" <?= ($status_cari == 'gagal') ? 'selected' : '' ?>>Gagal</option>
            </select>
        </form>
    </div>
    <div class="container" style="margin: 3rem 0;">
        <?php if (mysqli_num_rows($query) <= 0) {
            echo "<div class='kt-kosong'><h2>Data kegiatan kosong!</h2></div>";
        } ?>
    </div>
    <section class="list-kegiatan">

        <?php
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