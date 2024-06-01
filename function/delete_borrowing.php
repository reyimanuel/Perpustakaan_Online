<?php
include 'connection.php';

$id = $_GET['borrowings_id'];

$sql = "DELETE FROM borrowings WHERE borrowings_id='$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/management.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}