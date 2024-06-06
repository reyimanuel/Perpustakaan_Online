<?php 

include '../function/connection.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];

$query_admin_email = "SELECT email FROM users WHERE role = 'admin'";
$result_admin_email = mysqli_query($conn, $query_admin_email);
$admin_email = mysqli_fetch_assoc($result_admin_email)['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $books_id = $_POST['books_id'];
    $borrow_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime($borrow_date . ' + 14 days'));

    // Ambil judul buku
    $query = "SELECT title FROM books WHERE books_id = '$books_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];

    // Insert data peminjaman ke tabel borrowings
    $query = "INSERT INTO borrowings (borrow_date, return_date, username, books_id, title) 
              VALUES ('$borrow_date', '$return_date', '$username', '$books_id', '$title')";
    mysqli_query($conn, $query);

    // Update status buku menjadi 'dipinjam'
    $query = "UPDATE books SET status = 'dipinjam' WHERE books_id = '$books_id'";
    mysqli_query($conn, $query);

    header("Location: booklist.php");
    exit;
}
    $query_borrowings = "SELECT * FROM borrowings WHERE username = '$username'";
    $result_borrowings = mysqli_query($conn, $query_borrowings);

    $admin = query("SELECT * FROM users WHERE role = 'admin'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/user.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title>Peminjaman Buku</title>
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
        <a href="book_list.php">Daftar Buku</a>
        <a href="borrowing.php" class="active">Peminjaman Buku</a>
    </nav>


    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Halo <?php echo $_SESSION['username'] ?>!</h1>
        <span>Peminjaman</span>
      </div>

    <form class="borrow" action="borrowing.php" method="POST">
        <label for="books_id">Pilih Buku:</label>
        <select name="books_id" id="books_id" required>
            <?php
                $query = "SELECT books_id, title FROM books WHERE status = 'tersedia'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                     echo "<option value='{$row['books_id']}'>{$row['title']}</option>";
                }
            ?>
        </select>
        <input type="submit" value="Pinjam Buku">
        <p><i class="fa fa-envelope"></i><a href="mailto:<?php echo $admin_email ?>">Contact Admin</a></p>
    </form>

<!-- Table -->
    <div class="tableFix">
        <table id="table">
            <tr>
                <th>Nama Buku</th>
                <th>Waktu Peminjaman</th>
                <th>Waktu Pengembalian</th>
                <th>Pengguna</th>
            </tr>
            <?php foreach ( $result_borrowings as $borrow_row ): ?>
            <tr>
                <td><?= $borrow_row["title"]; ?></td>
                <td><?= $borrow_row["borrow_date"]; ?></td>
                <td><?= $borrow_row["return_date"]; ?></td>
                <td><?= $borrow_row["username"]; ?></td>
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