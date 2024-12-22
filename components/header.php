<?php

include "../koneksi/config.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar-nav">
        <div class="logo">
            <a href="">ITC | DoToList</a>
        </div>
        <div class="nav-list" id="nav-list">
            <p onclick="closeNav()" id="timesNav"><span>&times;</span></p>
            <a class="nav-link" href="../">Home</a>
            <a class="nav-link" href="./kegiatan.php">Kegiatan</a>
            <p class="nav-link badge-name"><span><?= $_SESSION['username'] ?></span></p>
            <a class="btn-logout" href="../logout.php">Logout</a>
        </div>
        <div class="nav-responsive">
            <p onclick="openNav()" id="hamburger"><span>=</span></p>
        </div>
    </nav>