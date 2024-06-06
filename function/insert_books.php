<?php
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $books_id = $_POST['books_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO books (books_id, title, author, published_year, genre) VALUES ('$books_id','$title', '$author', '$published_year', '$genre')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/book_management.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}