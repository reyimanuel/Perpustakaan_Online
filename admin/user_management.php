<?php 
require '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$users = query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Pengguna</title>
  <link rel="stylesheet" href="../styles/admin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="dashboard.php">Tsukareta</a>
    </div>

    <div class="header-icons">
      <div class="account">
        <details class="dropdown">
            <summary role="button">
                <i class="fas fa-user-alt"></i><a class="button"><?php echo $_SESSION['username'] ?></a>
            </summary>
                <ul>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="../function/logout.php">Logout</a></li>
                </ul>
        </details>
      </div>
    </div>

  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Main Menu</span>
        <a href="dashboard.php">Dashboard</a>
        <a href="book_management.php">Manajemen Buku</a>
        <a href="borrowing_management.php">Manajemen Peminjaman</a>
        <a href="user_management.php" class="active">Manajemen Pengguna</a>
        <a href="about.php">Designer! </a>
    </nav>


    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen Pengguna</span>
      </div>
      
<!-- Table -->
<div class="tableFix">
    <table id="table">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ( $users as $usr_row ): ?>
        <tr>
            <td><?= $usr_row["name"]; ?></td>
            <td><?= $usr_row["username"]; ?></td>
            <td><?= $usr_row["role"]; ?></td>
            <td><?= $usr_row["email"]; ?></td>
            <td>
                <a href="../function/edit_role.php?username=<?= $usr_row["username"] ?>" class="edit">Edit</a> || 
                <a href="../function/delete_user.php?username=<?= $usr_row["username"] ?>" class="hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <!-- Table -->

  </div>
  
    <footer class="footer-container">
        <p>Copyright &copy; 2024 all right reserved | Tsukareta</p>
    </footer>
</body>
</html>
</span>