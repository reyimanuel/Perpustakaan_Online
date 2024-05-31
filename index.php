<?php 
// Koneksi ke database
session_start();

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }
}

include 'function/connection.php'; 

// Mengambil data login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Cek data login
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $countRow = mysqli_num_rows($cek);

    if ($countRow > 0) {
        // Mengambil role user
        $takeRole = mysqli_fetch_array($cek);
        $role = $takeRole['role'];

        $data = mysqli_fetch_assoc($cek);
        $datUser_id = $data['user_id'];
        $datRole = $data['role'];
        $datEmail = $data['email'];
        
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $datUser_id; // Simpan ID pengguna ke dalam session
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $datRole;
        $_SESSION['email'] = $datEmail;

        // Jika role sebagai admin, maka akan diarahkan ke halaman admin
        if ($role == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header("Location: admin/dashboard.php");
        } else {
        // Jika role sebagai user, maka akan diarahkan ke halaman user
            header("Location: user/dashboard.php");
        }

    } else {
        if ($countRow == 0) {
            $err = "Username atau Password Salah!";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Login</title>
</head>
<body>
<main>
    <section class="wrapper">
    <div class="box">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    </section>
    <div class="login-main">
        <div class="login">
            <h1>Tsukareta</h1>
            <h2>Perpustakaan Online</h2>
            <h3>Silahkan Masukan Akun Anda</h3>
            <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
            <form action="" method="POST">
                <label for="username"> Username: </label>
                <input type="text" id="username" name="username" placeholder="Enter your Username" required>
    
                <label for="password"> Password: </label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
    
                <div class="wrap">
                    <button type="submit" name="login" onclick="solve()" value="Masuk Ke Sistem"> Submit </button>
                </div>
            </form>
            <p>Not registered? 
                  <a href="#" style="text-decoration: none;"> Create an account </a>
            </p>
        </div>
    </div>
</main>
</div>
</body>
</html>