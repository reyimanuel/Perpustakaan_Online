<?php 
require '../function/connection.php';

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
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Final Project</title>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <ul>
                <a href="dashboard.php" class="logo">Tsukareta</a>
                <li><a href="dashboard.php" class="active"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="management.php"><i class="fa fa-male"></i> Manajemen</a></li>
                <li><a href="#"> <i class="fa fa-bar-chart-o"></i> About</a></li>
            </ul>
        </nav>
    </header>
    <!-- Navigation Bar -->

    <main class="dashboard">
        <!-- Background -->
        <section class="wrapper-dashboard"> 
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
          
        <!-- Dropdown -->
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
      <!-- Dropdown -->

        <!-- Dashboard Info -->
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

            <div class="card reveal">
                <div class="dashboard-icon">
                    <img src="../images/reader.png" alt="Pembaca" width="50" height="50">
                </div>
                <a href="buku.html">
                <p>Pengguna</p>
              </a>
            </div>
        </div>
        <!-- Dashboard Info -->
        
        <footer class="footer-container">
           <p>Copyright &copy; 2024 all right reserved | Tsukareta</p>
          </footer>
          
        </section>
        <!-- Main Content -->
    </main>
</body>
</html>