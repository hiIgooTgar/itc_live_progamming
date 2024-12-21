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
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <nav class="navbar-nav">
        <div class="logo">
            <a href="">ITC | Do To List</a>
        </div>
        <div class="nav-list">
            <a class="nav-link" href="./">Home</a>
            <a class="nav-link" href="./src/kegiatan.php">Kegiatan</a>
            <a class="btn-logout" href="./logout.php">Logout</a>
        </div>
    </nav>
    <selection class="home">
        <div class="container">
            <h1>Selamat datang, <?= $_SESSION['nama'] ?></h1>
            <h1>Di Do To List | ITC Live Progamming</h1>
        </div>
    </selection>
    <footer>
        <p>&copy; ITC Live Progamming By Bug Busters | <span>
                <script>
                    document.write(new Date().getFullYear())
                </script>
            </span></p>
    </footer>
    <script src="./assets/js/script.js"></script>
</body>

</html>