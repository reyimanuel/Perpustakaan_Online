<?php 
// Koneksi ke database


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