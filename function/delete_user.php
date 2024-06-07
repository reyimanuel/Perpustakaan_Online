<?php
include 'connection.php';

$username = $_GET['username'];

$sql = "DELETE FROM users WHERE username='$username'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../admin/user_management.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
