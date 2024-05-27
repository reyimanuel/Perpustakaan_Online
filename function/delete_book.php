<?php
include 'connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM books WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../management.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>