<?php

include "../koneksi/config.php";
session_start();

if (isset($_POST['ubahStatus'])) {
    $id_kegiatan = $_POST['id_kegiatan'];
    $id_users = $_SESSION['id_users'];
    $status = $_POST['status'];

    $query = mysqli_query($conn, "UPDATE tbl_kegiatan SET status = '$status' WHERE id_kegiatan = '$id_kegiatan' AND id_users = '$id_users'");
    if ($query) {
        echo "<script>
                alert('Status kegiatan berhasil diubah');
                window.location.href = './kegiatan.php';
            </script>";
    } else {
        echo "<script>
                alert('Status kegiatan gagal diubah');
                window.location.href = './kegiatan.php';
            </script>";
    }
}
