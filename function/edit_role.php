<?php 
include 'connection.php';

$username = $_GET['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];

        $sql = "UPDATE users SET role = '$role' WHERE username='$username'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin/user_management.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <link rel="stylesheet" href="../styles/edit.css">
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
<div class="edit-form">
    <div class="edit-heading">
        <h1>Edit Role</h1>
    </div>
<form class="edit_book" method="POST" action="">
        <p class="error"><?php if (isset($err)) { echo $err; } ?></p>
        Role: 
        <select name="role">
            <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>User</option>
            <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="../admin/user_management.php">Kembali</a>
</div>
</main>
</body>
</html>