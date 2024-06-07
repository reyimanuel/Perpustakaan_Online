<?php 
require '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$borrowings = query("SELECT * FROM borrowings");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manajemen Peminjaman</title>
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
        <a href="borrowing_management.php" class="active">Manajemen Peminjaman</a>
        <a href="user_management.php">Manajemen Pengguna</a>
        <a href="about.html">Designer! </a>
    </nav>


    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Manajemen Peminjaman</span>
      </div>
      
<!-- Table -->
<div class="tableFix">
    <table id="table">
        <tr>
            <th>ID buku</th>
            <th>Nama Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Pengguna</th>
            <th>Aksi</th>
        </tr> 
        <?php foreach ( $borrowings as $borrow_row ): ?>    
        <tr>
            <td><?= $borrow_row["books_id"]; ?></td>
            <td><?= $borrow_row["title"]; ?></td>
            <td><?= $borrow_row["borrow_date"]; ?></td>
            <td><?= $borrow_row["return_date"]; ?></td>
            <td><?= $borrow_row["username"]; ?></td>
            <td>
                <a href="../function/delete_borrowing.php?borrowings_id=<?= $borrow_row["borrowings_id"] ?>" class="hapus">Hapus</a>
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



