<?php

include "./koneksi/config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DoToList</title>
    <link rel="stylesheet" href="./assets/css/auth.css">
</head>

<body>
    <section class="registrasi-section">
        <div class="left-col">
            <form action="" method="post">
                <h2>Registrasi Do To List</h2>
                <h1> <span>ITC</span> | Live Progamming</h1>
                <div class="group-input">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" required>
                </div>
                <div class="group-input">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="">-- Pilih Gender --</option>
                        <option value="">Laki-laki</option>
                        <option value="">Perempuan</option>
                    </select>
                </div>
                <div class="group-input">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
                </div>
                <button name="registrasi" class="btn-auth" type="submit">Registrasi</button>
                <p class="auth-foot">Apakah anda sudah punya akun? <a href="./login.php">Login</a> sekarang</p>
            </form>
        </div>
        <div class="right-col">
            <main>
                <h1>Do To List</h1>
                <h1>ITC | Live Progamming</h1>
            </main>
        </div>
    </section>
</body>

</html>


<?php

include "./koneksi/config.php";

if (isset($_POST['registrasi'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $nama = htmlspecialchars($_POST['nama']);
    $gender = htmlspecialchars($_POST['gender']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $cek_login = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");
    if (mysqli_num_rows($cek_login) > 0) {
        echo "<script>
                alert('Username sudah terdaftar!');
                window.location.href = './registrasi.php';
            </script>";
    } else {
        $query = "INSERT INTO tbl_users(id_users, username, password, nama, gender, alamat) 
        VALUES('', '$username', '$password', '$nama', '$gender', '$alamat')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>
                alert('Registrasi berhasil');
                window.location.href = './login.php';
            </script>";
        }
    }
}

?>