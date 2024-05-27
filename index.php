<?php 
session_start();
if (isset($_SESSION['admin_username'])) {
    header("Location: admin/dashboard.php");
}

include 'function/connection.php';
$username = "";
$password = "";
$err = "";


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" && $password == "") {
        $err = "<p>Silahkan masukan username dan password<p>";
    }
    if(empty($err)) {
        $sql1 = "SELECT * FROM admin WHERE username='$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);

        if ($r1['password'] != md5($password)) {
            $err = "<p>Username atau Password Salah<p>";
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
            <h2>Perpustakaan Online</h2>
            <h3>Silahkan Masukan Akun Anda</h3>
            <?php 
            if ($err) {
                echo "<p class='error'>$err</p>";
            }
            ?>
            <form action="" method="POST">
                <label for="username"> Username: </label>
                <input type="text" value="<?php echo $username ?>" id="username" name="username" placeholder="Enter your Username" required>
    
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