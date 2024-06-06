<?php 
require '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$book = query("SELECT * FROM books limit 0, 5");
$borrowings = query("SELECT * FROM borrowings limit 0, 5");
$users = query("SELECT * FROM users limit 0, 5");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
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
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="book_management.php">Manajemen Buku</a>
        <a href="borrowing_management.php">Manajemen Peminjaman</a>
        <a href="user_management.php">Manajemen Pengguna</a>
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
            <a href="book_management"><i class="fa fa-edit"></i>View More...</a>
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
            <a href="borrowing_management"><i class="fa fa-edit"></i>View More...</a>
          </div>
          <table class="table-show">
            <thead>
              <tr>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Pengguna</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ( $borrowings as $borrow_row ): ?>
              <tr>
                <td><?= $borrow_row["books_id"]; ?></td>
                <td><?= $borrow_row["title"]; ?></td>
                <td><?= $borrow_row["username"]; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="list3">
          <div class="row">
            <h4>Daftar User</h4>
            <a href="user_management"><i class="fa fa-edit"></i></a>
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
            <?php foreach ( $users as $users_row ): ?>
              <tr>
                <td><?= $users_row["username"]; ?></td>
                <td><?= $users_row["name"]; ?></td>
                <td><?= $users_row["email"]; ?></td>
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