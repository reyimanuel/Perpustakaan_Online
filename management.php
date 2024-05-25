<?php 
require 'function/connection.php';

$kategori = query("SELECT * FROM category");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- navigation bar -->
    <header>
        <nav>
            <ul>
                <a href="index.html" class="logo">Tsukareta</a>
                <li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <!-- <a href="#">Tambah Data</a> -->
                    </button>
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                          <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Menambahkan data kategori</h2>
                          </div>
                          <div class="modal-body">
                            <form action="function/simpan_kategori.php" method="POST">
                                <input type="text" placeholder="Nama Kategori" name="nama_kategori" required>
                                <input type="submit" value="simpan">
                            </form>
                          </div>
                        </div>
                      
                      </div>
                    <form action="">
                        <input type="text">
                        <input type="submit">
                    </form>
                </div>
            <table id="table">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                $i=1;
                foreach ( $kategori as $kat_row ): 
                ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?= $kat_row["category_name"]; ?></td>
                    <td><a href="" class="edit">Edit</a> || <a href="" class="hapus">Hapus</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            </div>

            <br><br>

            <div class="inner">
                <h2>Daftar Kategori</h2>
                <div class="add">
                    <button class="add-button">
                        <a href="#">Tambah Data</a>
                    </button>
                    <form action="">
                        <input type="text">
                        <input type="submit">
                    </form>
                </div>
            <table id="table">
                <tr>
                    <th>No</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>K-0001</td>
                    <td>Komputer</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>K-0002</td>
                    <td>Matematika</td>
                </tr>
            </table>
            </div>

            <br><br>

            <div class="inner">
                <h2>Daftar Kategori</h2>
                <div class="add">
                    <button class="add-button">
                        <a href="#">Tambah Data</a>
                    </button>
                    <form action="">
                        <input type="text">
                        <input type="submit">
                    </form>
                </div>
            <table id="table">
                <tr>
                    <th>No</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>K-0001</td>
                    <td>Komputer</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>K-0002</td>
                    <td>Matematika</td>
                </tr>
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
<script src="scripts/script.js"></script>
</html>