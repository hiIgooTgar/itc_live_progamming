<?php
include "../koneksi/config.php";
?>
<?php
$title = "Kegiatan Do To List | ITC Live Progamming";
include "../components/header.php";

if (!isset($_SESSION['id_users'])) {
    echo "<script>
                alert('Harap login dahulu');
                window.location.href = '../login.php';
            </script>";
}

$id_users = $_SESSION['id_users'];
$status_cari = isset($_GET['status']) ? $_GET['status'] : '0';

$where_kegiatan = "WHERE id_users = '$id_users'";
if ($status_cari !== '0') {
    $where_kegiatan .= " AND status = '$status_cari'";
}

$query = mysqli_query($conn, "SELECT * FROM tbl_kegiatan $where_kegiatan ORDER BY id_kegiatan DESC");
?>

<div class="container">
    <div class="search-col">
        <form action="" method="get">
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="0" <?= ($status_cari == '0') ? 'selected' : '' ?>>All</option>
                <option value="belum" <?= ($status_cari == 'belum') ? 'selected' : '' ?>>Belum</option>
                <option value="terlaksana" <?= ($status_cari == 'terlaksana') ? 'selected' : '' ?>>Terlaksana</option>
                <option value="gagal" <?= ($status_cari == 'gagal') ? 'selected' : '' ?>>Gagal</option>
            </select>
        </form>
    </div>
    <div class="row-kegiatan">
        <div class="left-col">
            <h1 class="heading">Tambah Kegiatan</h1>
            <form action="./proces_add_kegiatan.php" method="post">
                <div class="group-input">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input autofocus type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" name="tgl_kegiatan" class="form-control" id="tgl_kegiatan" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" required rows="10"></textarea>
                </div>
                <button name="addKegiatan" class="btn-submit" type="submit">Submit</button>
            </form>
        </div>
        <div class="right-col">
            <h1 class="heading">Data Kegiatan</h1>
            <?php
            if (mysqli_num_rows($query) <= 0) {
                echo "<div class='kt-kosong'><h2>Data kegiatan kosong!</h2></div>";
            }
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="card">
                    <div class="list">
                        <h3><?= $data['nama_kegiatan'] ?></h3>
                        <p class="tgl">Tanggal Kegiatan : <?= date("d F Y", strtotime($data['tgl_kegiatan'])) ?></p>
                        <p class="deskripsi"><?= $data['deskripsi'] ?></p>
                        <?php if ($data['status'] == 'belum') { ?>
                            <p class="status_belum"><?= $data['status'] = "Belum" ?></p>
                        <?php } else if ($data['status'] == 'terlaksana') { ?>
                            <p class="status_terlaksana"><?= $data['status'] = "Terlaksana" ?></p>
                        <?php } else if ($data['status'] == 'gagal') { ?>
                            <p class="status_gagal"><?= $data['status'] = "Gagal" ?></p>
                        <?php } ?>
                    </div>
                    <div class="aksi">
                        <form action="./update_kegiatan.php" method="post">
                            <input type="hidden" name="id_kegiatan" value="<?= $data['id_kegiatan'] ?>">
                            <?php $status = $data['status'] ?>
                            <select name="status" id="status">
                                <option <?= ($status == "Belum") ? "selected" : "" ?> value="belum">Belum</option>
                                <option <?= ($status == "Terlaksana") ? "selected" : "" ?> value="terlaksana">Terlaksana</option>
                                <option <?= ($status == "Gagal") ? "selected" : "" ?> value="gagal">Gagal</option>
                            </select>
                            <button onclick="return confirm('Anda ingin mengubah status kegiatan?');" name="ubahStatus" class="badge-ubah" type="submit">Submit</button>
                        </form>
                        <div>
                            <a onclick="return confirm('Anda ingin menghapus data kegiatan?');" class="badge-hapus" href="./delete_kegiatan.php?id_kegiatan=<?= $data['id_kegiatan'] ?>">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "../components/footer.php" ?>