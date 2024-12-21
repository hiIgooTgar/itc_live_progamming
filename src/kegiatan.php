<?php include "../koneksi/config.php";
?>
<?php include "../components/header.php";

if (!isset($_SESSION['id_users'])) {
    echo "<script>
                alert('Harap login dahulu');
                window.location.href = '../login.php';
            </script>";
} ?>
<div class="container">
    <div class="row-kegiatan">
        <div class="left-col">
            <h1 class="heading">Tambah Kegiatan </h1>
            <form action="./proces_add_kegiatan.php" method="post">
                <div class="group-input">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                    <input type="date" name="tgl_kegiatan" class="form-control" id="tgl_kegiatan" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                </div>
                <button name="addKegiatan" class="btn-submit" type="submit">Submit</button>
            </form>
        </div>
        <div class="right-col">
            <h1 class="heading">Data Kegiatan</h1>
            <?php
            $id_users = $_SESSION['id_users'];
            $query = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE id_users = '$id_users' ORDER BY id_kegiatan DESC");
            if (mysqli_num_rows($query) <= 0) {
                echo "<h2>Data kegiatan kosong!</h2>";
            }
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="card">
                    <div class="list">
                        <h3><?= $data['nama_kegiatan'] ?></h3>
                        <p>Tanggal Kegiatan : <?= date("d F Y", strtotime($data['tgl_kegiatan'])) ?></p>
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
                        <form action="update_kegiatan.php" method="post">
                            <input type="hidden" name="id_kegiatan">
                            <select name="status" id="status">
                                <?php if ($data['status'] == 'belum') { ?>
                                    <option value="<?= $data['status'] ?>">Belum</option>
                                <?php } else if ($data['status'] == 'terlaksana') { ?>
                                    <option value="<?= $data['status'] ?>">Terlaksana</option>
                                <?php } else if ($data['status'] == 'gagal') { ?>
                                    <option value="<?= $data['status'] ?>">Gagal</option>
                                <?php } ?>
                            </select>
                            <button name="addKegiatan" class="badge-ubah" type="submit">Submit</button>
                        </form>
                        <div>
                            <a class="badge-hapus" href="">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "../components/footer.php" ?>