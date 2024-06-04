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
$borrowings = query("SELECT * FROM borrowings");
$users = query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/admin.css">
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
 
   <main class="dashboard">

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
    <!-- Background -->

    <!-- Main Content -->
    <section class="content">    
        <section class="outer">

            <!-- Dropdown -->
            <div class="dropdown">
                <span class="fa fa-user-o">  <?php echo $_SESSION['username'] ?></span>
                <div class="dropdown-content">
                <a href="../function/logout.php">Logout</a>
                </div>
              </div>
            <div class="heading">
                <h1>Manajemen Data</h1>
            </div>
            <!-- Dropdown -->

            <div class="inner">
                <h2>Daftar Buku</h2>

                <!-- Adding book -->
                <div class="add">
                    <button class="add-button" id="myBtn">
                        Tambah Data
                    </button>
                    <form class="modal-form" action="">
                        <input type="text">
                        <input type="submit">
                    </form>
                </div>
                <!-- Adding book -->

                <!-- Table -->
            <table id="table">
                <tr>
                    <th>ID buku</th>
                    <th>Nama Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Perilisan</th>
                    <th>Genre</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                foreach ( $book as $book_row ): 
                ?>
                <tr>
                    <td><?= $book_row["books_id"]; ?></td>
                    <td><?= $book_row["title"]; ?></td>
                    <td><?= $book_row["author"]; ?></td>
                    <td><?= $book_row["published_year"]; ?></td>
                    <td><?= $book_row["genre"]; ?></td>
                    <td><?= $book_row["status"]; ?></td>
                    <td>
                        <a href="../function/edit_book.php?books_id=<?= $book_row["books_id"] ?>" class="edit">Edit</a> || 
                        <a href="../function/delete_book.php?books_id=<?= $book_row["books_id"] ?>" class="hapus">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <!-- Table -->

            <h2>Daftar Peminjaman</h2>
            <!-- Table -->
            <table id="table">
                <tr>
                    <th>ID buku</th>
                    <th>Nama Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Pengguna</th>
                    <th>Aksi</th>
                </tr>
                
                <?php 
                foreach ( $borrowings as $borrow_row ): 
                ?>
                
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
            <!-- Table -->

            <h2>Daftar Pengguna</h2>
            <!-- Table -->
            <table id="table">
                <tr>
                    <th>username</th>
                    <th>role</th>
                    <th>email</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                foreach ( $users as $usr_row ): 
                ?>
                <tr>
                    <td><?= $usr_row["username"]; ?></td>
                    <td><?= $usr_row["role"]; ?></td>
                    <td><?= $usr_row["email"]; ?></td>
                    <td>
                        <a href="../function/edit_user.php?username=<?= $usr_row["username"] ?>" class="edit">Edit</a> || 
                        <a href="../function/delete_user.php?username=<?= $usr_row["username"] ?>" class="hapus">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <!-- Table -->

            </div>
    </section>

    </section>
    <!-- Main Content -->

    <!-- Footer -->
    <footer class="footer-container">
        <p>Copyright &copy; 2024 all right reserved | Tsukareta</p>
    </footer>
    <!-- Footer -->

    </main>
</body>
<!-- add modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
    <div class="modal-content">
   
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Menambahkan data buku</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form" action="../function/insert_books.php" method="POST">
                <input type="text" placeholder="ID Buku" name="books_id" required>
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