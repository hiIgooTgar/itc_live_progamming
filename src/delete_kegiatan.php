<?php

include "../koneksi/config.php";
session_start();

$id_kegiatan = $_GET['id_kegiatan'];
$id_users = $_SESSION['id_users'];

$query = mysqli_query($conn, "DELETE FROM tbl_kegiatan WHERE id_kegiatan = '$id_kegiatan' AND id_users = '$id_users'");
if ($query) {
    echo "<script>
                alert('Data kegiatan berhasil dihapus');
                window.location.href = './kegiatan.php';
            </script>";
} else {
    echo "<script>
                alert('Data kegiatan gagal dihapus');
                window.location.href = './kegiatan.php';
            </script>";
}
