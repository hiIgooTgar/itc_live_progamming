<?php

include "../koneksi/config.php";
session_start();

if (isset($_POST['addKegiatan'])) {
    $nama_kegiatan = htmlspecialchars($_POST['nama_kegiatan']);
    $tgl_kegiatan = htmlspecialchars($_POST['tgl_kegiatan']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $status = "belum";
    $id_users = $_SESSION['id_users'];

    $cek_kegiatan = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE nama_kegiatan = '$nama_kegiatan' AND id_users = '$id_users'");
    if (mysqli_num_rows($cek_kegiatan) > 0) {
        echo "<script>
                alert('Nama kegiatan telah terdaftar');
                window.location.href = './kegiatan.php';
            </script>";
    } else {
        $query = mysqli_query($conn, "INSERT INTO tbl_kegiatan(id_kegiatan, nama_kegiatan, tgl_kegiatan, deskripsi, status, id_users)
        VALUES('', '$nama_kegiatan', '$tgl_kegiatan', '$deskripsi', '$status', '$id_users')");

        if ($query) {
            echo "<script>
                alert('Data kegiatan berhasil ditambahkan');
                window.location.href = './kegiatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data kegiatan berhasil ditambahkan');
                window.location.href = './kegiatan.php';
            </script>";
        }
    }
}
