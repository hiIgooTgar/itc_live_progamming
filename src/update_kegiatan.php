<?php

include "../koneksi/config.php";
session_start();

$id_kegiatan = $_GET['id_kegiatan'];

if (isset($_POST['ubahStatus'])) {
    $id_users = $_SESSION['id_users'];
    $status = htmlspecialchars($_POST['status']);

    $query = mysqli_query($conn, "UPDATE tbl_kegiatan SET status = '$status' WHERE id_kegiatan = '$id_kegiatan' AND id_users = '$id_users'");
    echo "<script>
                alert('Status kegiatan berhasil diubah');
                window.location.href = './kegiatan.php';
            </script>";
}
