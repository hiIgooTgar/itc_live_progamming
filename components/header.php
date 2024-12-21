<?php

include "../koneksi/config.php";
session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar-nav">
        <div class="logo">
            <a href="">ITC | Do To List</a>
        </div>
        <div class="nav-list">
            <a class="nav-link" href="../">Home</a>
            <a class="nav-link" href="./kegiatan.php">Kegiatan</a>
            <a class="btn-logout" href="../logout.php">Logout</a>
        </div>
    </nav>