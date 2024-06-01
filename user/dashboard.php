<?php 
include '../function/connection.php';

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);


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
       <!-- Navigation Bar -->
       <header>
        <nav>
            <ul>
                <a href="dashboard.php" class="logo">Tsukareta</a>
                <li><a href="dashboard.php" class="active"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="booklist.php"><i class="fa fa-male"></i> Peminjaman</a></li>
                <li><a href="#"> <i class="fa fa-bar-chart-o"></i> About</a></li>
            </ul>
        </nav>
    </header>
    <!-- Navigation Bar -->

    <!-- Main Content -->
    <main class="index">
        <!-- Background -->
        <section class="wrapper-index"> 
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
        <section class="all-content">
          
          <div class="dropdown">
            <span class="fa fa-user-o"> <?php echo $_SESSION['username'] ?></span>
            <div class="dropdown-content">
            <a href="../function/logout.php">Logout</a>
            </div>
          </div>
    
          <div class="heading">
        <h1>Perpustakaan Online</h1>
          <p> 
           Selamat datang <?php echo $_SESSION['username'] ?>. Silahkan pilih menu yang tersedia untuk melihat informasi lebih lanjut.
          </p>
      </div>

        <div class="dashboard-info">

            <div class="card reveal">
                <div class="dashboard-icon">
                    <img src="../images/book.png" alt="Buku" width="50" height="50">
                </div>
                <a href="buku.html">
                <p>Buku</p>
              </a>
            </div>

            <div class="card reveal">
                <div class="dashboard-icon">
                    <img src="../images/borrowing.png" alt="Peminjaman" width="50" height="50">
                </div>
                <a href="buku.html">
                <p>Peminjaman</p>
              </a>
            </div>

            <div class="card reveal">
                <div class="dashboard-icon">
                    <img src="../images/return.png" alt="return" width="50" height="50">
                </div>
                <a href="buku.html">
                <p>Pengembalian</p>
              </a>
            </div>

<footer class="footer-container">
  <p>Copyright &copy; 2024 all right reserved | Tsukareta</p>
</footer>
        </section>
    </main>
</body>
</html>