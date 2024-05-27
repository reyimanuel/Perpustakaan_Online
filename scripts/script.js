var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// test
// Fungsi untuk membuka modal edit
function openEditModal(id) {
  var modal = document.getElementById('editModal');
  modal.style.display = 'block';

  // Isi data buku pada form edit
  var title = document.getElementById('editTitle');
  var author = document.getElementById('editAuthor');
  var year = document.getElementById('editYear');
  var genre = document.getElementById('editGenre');
  var status = document.getElementById('editStatus');

  // Ambil data buku dari server
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var book = JSON.parse(this.responseText);
          document.getElementById('editId').value = book.id;
          title.value = book.title;
          author.value = book.author;
          year.value = book.published_year;
          genre.value = book.genre;
          status.value = book.status;
      }
  };
  xhttp.open('GET', 'get_book.php?id=' + id, true);
  xhttp.send();
}

// Fungsi untuk menutup modal edit
function closeEditModal() {
  var modal = document.getElementById('editModal');
  modal.style.display = 'none';
}

// Fungsi untuk mengirim form edit
document.getElementById('editForm').addEventListener('submit', function(e) {
  e.preventDefault();
  var form = this;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          window.location.reload(); // Refresh halaman setelah edit berhasil
      }
  };
  xhttp.open('POST', 'edit_book.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send(new URLSearchParams(new FormData(form)).toString());
});