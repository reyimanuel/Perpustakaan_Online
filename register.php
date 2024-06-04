<?php 
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
    <title>Register/Login</title>
</head>
<body>

<div class="container" id="container">
    <div class="form-container sign-up">
        <form>
            <h1>Create Account</h1>
            <span>Kindly fill the form to register</span>
            <input type="text" placeholder="Name">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Password">
            <button>Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="" method="POST">
            <h1>Sign In</h1>
            <span>Enter your credential</span>
                <input type="text" id="username" name="username" placeholder="Enter your Username" required>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            <a href="#">Forgot Your Password?</a>
            <button type="submit" name="login" value="Masuk Ke Sistem">Sign In</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome newcomers!</h1>
                <p>Already have an account? Come on in!</p>
                <button class="hidden" id="signin">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Don't have an account yet? Join us as we venture the world of knowledge! </p>
                <button class="hidden" id="signup">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script src="../scripts/script.js"></script>
</body>
</html>