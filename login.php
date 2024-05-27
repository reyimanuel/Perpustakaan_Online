<?php 
include 'function/connection.php';
$username = "";
$password = "";
$err = "";


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" && $password == "") {
        $err = "<li>Silahkan masukan username dan password</li>";
    }
    if(empty($err)) {
        $sql1 = "SELECT * FROM admin WHERE username='$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if ($r1['password'] != md5($password)) {
            $err = "<li>Akun tidak ditemukan</li>";
        }
    }

    if (empty($err)) {
        $_SESSION['admin_username'] = $username;
        header("Location: admin/dashboard.php");
        exit();
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
            <h3>Enter your login credentials</h3>
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