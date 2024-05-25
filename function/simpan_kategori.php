<?php
include 'connection.php';


$nama_kategori = $_POST['nama_kategori'];
$query = mysqli_query($conn, "INSERT INTO category (category_name)VALUES ('$nama_kategori')");
header('location:../management.php');
