<?php 
include 'connection.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];
    $genre = $_POST['genre'];
    $status = $_POST['status'];

    $sql = "UPDATE books SET title='$title', author='$author', published_year='$published_year', genre='$genre', status='$status' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../management.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM books WHERE id='$id'");
$book = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<main>
<section class="wrapper">
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
<div class="edit-heading">
<h1>Edit Buku</h1>
</div>

<div class="edit-form">
<form class="edit_book" method="POST" action="">
        Judul: <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br>
        Penulis: <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br>
        Tahun Terbit: <input type="number" name="published_year" value="<?php echo $book['published_year']; ?>" required><br>
        Genre: <input type="text" name="genre" value="<?php echo $book['genre']; ?>" required><br>
        Status: 
        <select name="status">
            <option value="tersedia" <?php if($book['status'] == 'tersedia') echo 'selected'; ?>>Tersedia</option>
            <option value="dipinjam" <?php if($book['status'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
        </select><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="../management.php">Kembali</a>
</div>
</main>
</body>
</html>