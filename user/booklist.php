<?php
include '../function/connection.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- navigation bar -->
    <header>
        <nav>
            <ul>
                <a href="dashboard.php" class="logo">Tsukareta</a>
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="booklist.php" class="active"><i class="fa fa-male"></i> Peminjaman</a></li>
                <li><a href="#"> <i class="fa fa-bar-chart-o"></i> About</a></li>
            </ul>
        </nav>
    </header>
   <!-- Main Content -->
   <main class="dashboard">
    <!-- Background -->
    <section class="wrapper-booklist"> 
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
    <section class="content">    
        <section class="outer">
            <div class="dropdown">
                <span class="fa fa-user-o"> <?php echo $_SESSION['username'] ?></span>
                <div class="dropdown-content">
                <a href="../function/logout.php">Logout</a>
                </div>
              </div>
            <div class="heading">
                <h1>Peminjaman Buku</h1>
            </div>
            
            <div class="inner">
                <div class="info">
                    <h2 class="borrow-heading">Informasi Peminjaman</h2>
                    <p>Pada halaman ini, anda dapat meminjam buku dan diberikan jangka waktu 14 hari untuk dikembalikan.</p>
                </div>
                
                                
                <form class="borrow" action="booklist.php" method="POST">
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
                </form>

                <h2 class="borrow-heading" >Daftar Buku yang Dipinjam</h2>
                <table id="table">
                <tr>
                    <th>Nama Buku</th>
                    <th>Waktu Peminjaman</th>
                    <th>Waktu Pengembalian</th>
                    <th>Pengguna</th>
                </tr>
                <?php 
                foreach ( $result_borrowings as $borrow_row ): 
                ?>
                <tr>
                    <td><?= $borrow_row["title"]; ?></td>
                    <td><?= $borrow_row["borrow_date"]; ?></td>
                    <td><?= $borrow_row["return_date"]; ?></td>
                    <td><?= $borrow_row["username"]; ?></td>
                </tr>
                <?php endforeach; ?>
                </table>
            </div>
    </section>

    <footer class="footer-container">
        <p>Copyright &copy; 2024 all right reserved | Tsukareta</p>
      </footer>

    </section>
    </main>
    <!-- Main Content -->
</body>
<script src="../scripts/script.js"></script>
</html>