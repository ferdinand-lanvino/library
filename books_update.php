<?php
include('templates/header.php');
include_once('db/books_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cover_url = null;
    $ebook_url = null;

    $book_id = $_POST['book_id'];
    $book = BooksDB::get($book_id);

    //Cek apakah terdapat cover yang diupload
    if ($_FILES['cover_url']['name'] != null) {
        //Jika ada, hapus cover lama
        unlink($book->getCoverUrl());
        //Simpan cover yang baru
        $cover_upload_to = 'files/covers/';
        $cover_filename = $_FILES['cover_url']['name'];
        $cover_tmp_filename = $_FILES['cover_url']['tmp_name'];
        $cover_url = $cover_upload_to . $cover_filename;
        $coverUploaded = move_uploaded_file($cover_tmp_filename, $cover_url);
    }
    //Cek apakah terdapat ebook yang diupload
    if ($_FILES['ebook_url']['name'] != null) {
        //Jika ada, hapus ebook lama
        unlink($book->getEbookUrl());
        //Simpan ebook yang baru
        $ebook_upload_to = 'files/ebooks/';
        $ebook_filename = $_FILES['ebook_url']['name'];
        $ebook_tmp_filename = $_FILES['ebook_url']['tmp_name'];
        $ebook_url = $ebook_upload_to . $ebook_filename;
        $ebookUploaded = move_uploaded_file($ebook_tmp_filename, $ebook_url);
    }
    //Ambil data dari form
    $author_id = $_POST['author_id'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $total_pages = $_POST['total_pages'];
    $rating = $_POST['rating'];

    $book = new Book(
        $book_id,
        $author_id,
        $isbn,
        $title,
        $total_pages,
        $rating,
        $ebook_url??$book->getEbookUrl(),//Jika tidak ada ebook yang diupload, maka gunakan ebook lama
        $cover_url??$book->getCoverUrl(),//Jika tidak ada cover yang diupload, maka gunakan cover lama
        $book->getTotalViews()
    );

    BooksDB::update($book);

    header('Location: books.php');
} else {
    $book_id = $_GET['book_id'] ?? '';
    $book = BooksDB::get($book_id);
}
?>

<?php if (isset($book)) : ?>
    <section class="py-1 text-center container">
        <div class="row">
            <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
                Edit Books
            </h2>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                include_once('db/authors_db.php');
                $authors = AuthorsDB::all();
                ?>
                <div class="mb-3">
                    <label for="inp_isbn" class="form-label">Author</label>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="author_id">
                        <?php foreach ($authors as $author) : ?>
                            <option <?= $author->getAuthorId() == $book->getAuthorId() ? 'selected' : '' ?> value="<?php echo $author->getAuthorId(); ?>">
                                <?php echo $author->getAuthorName(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="book_id" value="<?= $book->getBookId() ?>">
                <div class="mb-3">
                    <label for="inp_isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" maxlength="13" id="inp_isbn" name="isbn" value="<?= $book->getIsbn() ?>">
                </div>
                <div class="mb-3">
                    <label for="inp_title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="inp_title" name="title" value="<?= $book->getTitle() ?>">
                </div>
                <div class="mb-3">
                    <label for="inp_total_pages" class="form-label">Total Pages</label>
                    <input type="number" class="form-control" id="inp_total_pages" name="total_pages" value="<?= $book->getTotalPages() ?>">
                </div>
                <div class="mb-3">
                    <label for="inp_rating" class="form-label">Rating</label>
                    <input type="number" class="form-control" min=1 max=5 step="0.1" id="inp_rating" name="rating" value="<?= $book->getRating() ?>">
                </div>
                <div class="mb-4">
                    <img src="<?= $book->getCoverUrl() ?>" class="img-thumbnail" style="height:300px;object-fit:contain;">
                </div>
                <div class="mb-3">
                    <label for="inp_cover_url" class="form-label">Replace cover</label>
                    <input class="form-control" type="file" id="inp_cover_url" name="cover_url">
                </div>
                <div class="mb-3">
                    <div><a href="reader.php?book_id=<?= $book->getBookId() ?>">Show Ebook</a></div>
                    <label for="inp_ebook_url" class="form-label">Replace e-book</label>
                    <input class="form-control" type="file" id="inp_ebook_url" name="ebook_url">
                </div>
                <button type="submit" class="btn btn-primary mb-5">Add New Book</button>
            </form>
        </div>
    </div>

<?php else : ?>
    <div class="container">
        <div class="row">
            <h2>Author not found</h2>
        </div>
    </div>
<?php endif; ?>

<?php include('templates/footer.php'); ?>