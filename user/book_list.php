<?php 
require '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$book = query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Buku</title>
  <link rel="stylesheet" href="../styles/user.css" />
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
        <a href="book_list.php" class="active">Daftar Buku</a>
        <a href="borrowing.php">Peminjaman Buku</a>
        <a href="about.html">Designer! </a>
    </nav>


    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Daftar Buku</span>
      </div>

<!-- Table -->
<div class="tableFix">
    <table id="table">
        <tr>
            <th>ID buku</th>
            <th>Nama Buku</th>
            <th>Penulis</th>
            <th>Tahun Perilisan</th>
            <th>Genre</th>
            <th>Status</th>
        </tr>
        <?php foreach ( $book as $book_row ): ?>
        <tr>
            <td><?= $book_row["books_id"]; ?></td>
            <td><?= $book_row["title"]; ?></td>
            <td><?= $book_row["author"]; ?></td>
            <td><?= $book_row["published_year"]; ?></td>
            <td><?= $book_row["genre"]; ?></td>
            <td><?= $book_row["status"]; ?></td>
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