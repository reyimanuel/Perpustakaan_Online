<?php
include '../function/connection.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];

// Fetch the current user information
$query = "SELECT name, email FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update user information
    $query = "UPDATE users SET name = '$name', email = '$email' WHERE username = '$username'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Profile updated successfully";
    } else {
        $_SESSION['message'] = "Error updating profile: " . mysqli_error($conn);
    }

    header("Location: profile_update.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../styles/profile.css">
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
    </div>
</section>

    <div class="profile-form">
        <div class="edit-heading">
            <h1>Profile</h1>
        </div>
       
        <?php if (isset($_SESSION['message'])): ?>
            <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>

        <form class="update-profile" action="profile_update.php" method="POST">
            <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <input type="submit" value="Update Profile">
        </form>
    <a href="dashboard.php">Kembali</a>
    </div>
</main>
</body>
</html>
