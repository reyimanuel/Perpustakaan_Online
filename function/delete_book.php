<?php
include 'connection.php';

$books_id = $_GET['books_id'];

$sql = "DELETE FROM books WHERE books_id='$books_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/management.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
