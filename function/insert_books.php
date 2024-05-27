<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO books (title, author, published_year, genre) VALUES ('$title', '$author', '$published_year', '$genre')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../management.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}