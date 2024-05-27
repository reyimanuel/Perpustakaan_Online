<?php 
require 'function/connection.php';

$book = query("SELECT * FROM books");
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
                <li><a href="management.html" class="active"><i class="fa fa-male"></i> Management</a></li>
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
                <a href="profile">Pofile</a>
                <a href="">Logout</a>
                </div>
              </div>
            <div class="heading">
                <h1>Manajemen Data</h1>
            </div>
            
            <div class="inner">
                <h2>Daftar Kategori</h2>
                <div class="add">
                    <button class="add-button" id="myBtn">
                        Tambah Data
                    </button>
                    <form class="modal-form" action="">
                        <input type="text">
                        <input type="submit">
                    </form>
                </div>
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
                $i=1;
                foreach ( $book as $book_row ): 
                ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?= $book_row["title"]; ?></td>
                    <td><?= $book_row["author"]; ?></td>
                    <td><?= $book_row["published_year"]; ?></td>
                    <td><?= $book_row["genre"]; ?></td>
                    <td><?= $book_row["status"]; ?></td>
                    <td>
                        <a href="function/edit_book.php?id=<?= $book_row["id"] ?>" class="edit">Edit</a>|| 
                        <a href="function/delete_book.php?id=<?= $book_row["id"] ?>" class="hapus">Hapus</a>
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
            <h2>Menambahkan data buku</h2>
        </div>
        
        <div class="modal-body">
            <form class="modal-form" action="function/insert_books.php" method="POST">
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
<script src="scripts/script.js"></script>
</html>