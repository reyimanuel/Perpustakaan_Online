<?php 
require '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
  exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $books_id = $_POST['books_id'];
    $borrow_date = date('Y-m-d'); // Tanggal peminjaman saat ini

    // Cek ketersediaan buku
    $check_query = "SELECT status FROM books WHERE books_id = '$books_id'";
    $check_result = mysqli_query($conn, $check_query);
    $book = mysqli_fetch_assoc($check_result);

    if ($book['status'] == 'tersedia') {
        // Insert ke tabel borrowings
        $insert_query = "INSERT INTO borrowings (username, books_id, borrow_date) VALUES ('$username', '$books_id', '$borrow_date')";
        mysqli_query($conn, $insert_query);

        // Update status buku
        $update_query = "UPDATE books SET status = 'dipinjam' WHERE books_id = '$books_id'";
        mysqli_query($conn, $update_query);

        $message = "<p class=''success>Buku berhasil dipinjam!</p>";
    } else {
        $message = "<p class='error'>Buku tidak tersedia.</p>";
    }
}

// Query untuk mengambil informasi buku
$books_query = "SELECT * FROM books WHERE status = 'tersedia'";
$books_result = mysqli_query($conn, $books_query);
$borrowings_query = "SELECT * FROM borrowings";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- navigation bar -->
    <header>
        <nav>
            <ul>
                <a href="dashboard.php" class="logo">Tsukareta</a>
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="management.html" class="active"><i class="fa fa-male"></i> Manajemen</a></li>
                <li><a href="#"> <i class="fa fa-bar-chart-o"></i> About</a></li>
            </ul>
        </nav>
    </header>
   <!-- Main Content -->
   <main class="index">
    <!-- Background -->
    <section class="wrapper-management"> 
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
                <span class="fa fa-user-o"> User</span>
                <div class="dropdown-content">
                <a href="../function/logout.php">Logout</a>
                </div>
              </div>
            <div class="heading">
                <h1>Manajemen Data</h1>
            </div>
            
            <div class="inner">
                <h2>Daftar Kategori</h2>
            
                <form class="borrow" method="POST" action="">
                <?php if (!empty($message)) { echo "$message"; } ?>
                    <label for="books_id">Pilih Buku:</label>
                    <select name="books_id" id="books_id" required>
                        <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                            <option value="<?php echo $book['books_id']; ?>"><?php echo htmlspecialchars($book['title']); ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit">Pinjam Buku</button>
                </form>

            <table id="table">
                <tr>
                    <th>No</th>
                    <th>Nama Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Perilisan</th>
                    <th>Genre</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                foreach ( $borrowings_query as $borrow_row ): 
                ?>
                <tr>
                    <td><?= $borrow_row["title"]; ?></td>
                    <td><?= $borrow_row["author"]; ?></td>
                    <td><?= $borrow_row["published_year"]; ?></td>
                    <td><?= $borrow_row["genre"]; ?></td>
                    <td><?= $borrow_row["status"]; ?></td>
                    <td>
                        <div class="add">
                            <button class="add-button" id="myBtn">
                            Pinjam Buku
                            </button>
                        </div>
                    </td>
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
<!-- add modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
    <div class="modal-content">
   
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Peminjaman Buku</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form" action="../function/insert_books.php" method="POST">
                <input type="text" placeholder="Judul Buku" name="title" required>
                <input type="text" placeholder="Penulis" name="author" required>
                <input type="number" placeholder="Tahun Perilisan" name="published_year" required>
                <input type="text" placeholder="genre" name="genre" required>
                <input type="submit" value="simpan">
            </form>
        </div>
    
    </div>            
</div>
<!-- add modal -->
<script src="../scripts/script.js"></script>
</html>