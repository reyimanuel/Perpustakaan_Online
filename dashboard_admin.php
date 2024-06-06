<?php 
require 'function/connection.php';

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
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles/admin_test.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="#">Tsukareta</a>
    </div>

    <div class="header-icons">
      <div class="account">
        <details class="dropdown">
            <summary role="button">
                <a class="button">user</a>
            </summary>
                <ul>
                    <li><a href="#">I'm a dropdown.</a></li>
                    <li><a href="#">In Pure CSS</a></li>
                    <li><a href="#">As in...</a></li>
                    <li><a href="#">No JavaScript.</a></li>
                    <li><a href="#">At All.</a></li>
                </ul>
        </details>
      </div>
    </div>

  </header>
  <div class="container">
    <nav>
      <div class="side_navbar">
        <span>Main Menu</span>
        <a href="#" class="active">Dashboard</a>
        <a href="#">Profile</a>
        <a href="#">History</a>
        <a href="#">Application</a>
        <a href="#">My Account</a>
        <a href="#">Documnets</a>

        <div class="links">
          <span>Quick Link</span>
          <a href="#">Paypal</a>
          <a href="#">EasyPay</a>
          <a href="#">SadaPay</a>
        </div>
      </div>
    </nav>

    <div class="main-body">
      <h2>Dashboard</h2>
      <div class="promo_card">
        <h1>Selamat Datang di Tsukareta</h1>
        <span>Lorem ipsum dolor sit amet.</span>
        <button>Learn More</button>
      </div>

      <div class="history_lists">
        <div class="list1">
          <div class="row">
            <h4>History</h4>
            <a href="#">See all</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Dates</th>
                <th>Name</th>
                <th>Type</th>
                <th>Ammount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>2, Aug, 2022</td>
                <td>Sam Tonny</td>
                <td>Premimum</td>
                <td>$2000.00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>29, July, 2022</td>
                
                <td>Code Info</td>
                <td>Silver</td>
                <td>$5,000.00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>15, July, 2022</td>
              
                <td>Jhon David</td>
                <td>Startup</td>
                <td>$3000.00</td>
              </tr>
              <tr>
                <td>4</td>
                <td>5, July, 2022</td>
                <td>Salina Gomiz</td>
                <td>Premimum</td>
                <td>$7000.00</td>
              </tr>
              <tr>
                <td>5</td>
                <td>29, June, 2022</td>
                <td>Gomiz</td>
                <td>Gold</td>
                <td>$4000.00</td>
              </tr>
              <tr>
                <td>6</td>
                <td>28, June, 2022</td>
                <td>Elyana Jhon</td>
                <td>Premimum</td>
                <td>$2000.00</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="list2">
          <div class="row">
            <h4>Documnets</h4>
            <a href="#">Upload</a>
          </div>
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Uplaoded</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>CNIC</td>
                <td>PDF</td>
                <td>20</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Passport</td>
                <td>PDF</td>
                <td>12</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Licence</td>
                <td>PDF</td>
                <td>9</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Pic</td>
                <td>Jpg</td>
                <td>22</td>
              </tr> 
              <tr>
                <td>5</td>
                <td>CNIC</td>
                <td>Jpg</td>
                <td>22</td>
              </tr> 
              <tr>
                <td>6</td>
                <td>Docx</td>
                <td>Word</td>
                <td>22</td>
              </tr> 
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
</span>