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
$messages = "";
// Mengambil data login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek data login
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($cek && mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_assoc($cek);

        if (password_verify($password, $data['password'])) {
            // Mengambil role user
            $datUser_id = $data['user_id'];
            $datRole = $data['role'];
            $datEmail = $data['email'];
            
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $datRole;
            $_SESSION['email'] = $datEmail;

            // Jika role sebagai admin, maka akan diarahkan ke halaman admin
            if ($datRole == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                // Jika role sebagai user, maka akan diarahkan ke halaman user
                header("Location: user/dashboard.php");
            }
        } else {
            $messages .= "<div class='alert-danger'>Username atau Password Salah!</div>";
        }
    } else {
        $messages .= "<div class='alert-danger'>Username atau Password Salah!</div>";
    }
}

if (isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $usname = $_POST["usname"];
    $email = $_POST["email"];
    $password = $_POST["pswrd"];
    $passwordRepeat = $_POST["repeat_pswrd"];
    
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();
    
    if (empty($fullName) || empty($usname) || empty($email) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "Semua kolom harus diisi!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email tidak valid!");
    }
    if (strlen($password) < 4) {
        array_push($errors, "Password setidaknya harus 4 karakter!");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors, "Password tidak sama!");
    }
    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        array_push($errors, "SQL error");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Email sudah ada!");
        }
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            $messages .= "<div class='alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO users (username, name, email, password, role) VALUES (?, ?, ?, ?, 'user')";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Something went wrong");
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $usname, $fullName, $email, $password_hash);
            mysqli_stmt_execute($stmt);
            $messages .= "<div class='alert-success'>Akun kamu berhasil teregistrasi.</div>";
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
        <form action="index.php" method="POST">
            <h1>Create Account</h1>
            <span>Kindly fill the form to register</span>
            <input type="text" name="fullname" id="fullName" placeholder="Enter your name">
            <input type="text" name="usname" id="usname" placeholder="Enter your username">
            <input type="email" name= "email" id="email" placeholder="Enter your email">
            <input type="password" name="pswrd" id="pswrd" placeholder="Enter your password">
            <input type="password" name="repeat_pswrd" id="repeat_pswrd" placeholder="Repeat your password">
            <button type="submit" name="submit" value="Daftar Akun">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="" method="POST">
            <h1>Sign In</h1>
            <span>Enter your credential</span>
            <?php echo $messages; ?>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
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

<script src="scripts/script.js"></script>
</body>
</html>