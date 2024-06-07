<?php 
include '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$query_borrowings = "SELECT * FROM borrowings WHERE username = '$username' limit 0, 5";
$result_borrowings = mysqli_query($conn, $query_borrowings);
$book = query("SELECT * FROM books limit 0, 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard</title>
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
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="book_list.php">Daftar Buku</a>
        <a href="borrowing.php">Peminjaman Buku</a>
        <a href="about.html">Designer! </a>
    </nav>

    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Selamat Datang di Website Tsukareta</span>
      </div>

      <div class="borrowing_lists">
            
        <div class="list1">
          <div class="row">
            <h4>Daftar Buku</h4>
            <a href="borrowing.php"><i class="fas fa-book"></i>View More...</a>
          </div>
          <table class="table-show">
            <thead>
              <tr>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ( $book as $book_row ): ?>
              <tr>
                <td><?= $book_row["books_id"]; ?></td>
                <td><?= $book_row["title"]; ?></td>
                <td><?= $book_row["status"]; ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="list2">
          <div class="row">
            <h4>Data Peminjaman</h4>
            <a href="borrowing.php"><i class="fas fa-book"></i>View More...</a>
          </div>
          <table class="table-show">
            <thead>
              <tr>
                <th>Nama Buku</th>
                <th>Waktu Peminjaman</th>
                <th>Waktu Pengembalian</th>
                <th>Pengguna</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ( $result_borrowings as $borrow_row ): ?>
              <tr>
                <td><?= $borrow_row["title"]; ?></td>
                <td><?= $borrow_row["borrow_date"]; ?></td>
                <td><?= $borrow_row["return_date"]; ?></td>
                <td><?= $borrow_row["username"]; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
  
    <footer class="footer-container">
        <p>Copyright &copy; 2024 all right reserved | Tsukareta</p>
    </footer>
</body>
</html>
</span>