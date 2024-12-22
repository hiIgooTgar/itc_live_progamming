<?php

include "./koneksi/config.php";
session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DoToList</title>
</head>

<body>
    <section class="container">
        <form action="" method="post">
            <div class="group-input">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" autocomplete="off" required>
            </div>
            <div class="group-input">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
            </div>
            <button name="login" type="submit">Login</button>
        </form>
    </section>
</body>

</html>


<?php

include "./koneksi/config.php";

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $cek_login = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");
    if (mysqli_num_rows($cek_login) > 0) {
        $data = mysqli_fetch_array($cek_login);
        if (password_verify($password, $data['password'])) {
            $_SESSION['login'] = 1;
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['gender'] = $data['gender'];
            $_SESSION['alamat'] = $data['alamat'];
            $_SESSION['id_users'] = $data['id_users'];
            header("Location: ./");
        } else {
            echo "<script>
                alert('Password anda salah!');
                window.location.href = './login.php';
            </script>";
        }
    } else {
        echo "<script>
                alert('Username dan password anda salah!');
                window.location.href = './login.php';
            </script>";
    }
}

?>