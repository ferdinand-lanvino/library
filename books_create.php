<?php
include('templates/header.php');
include_once('db/books_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cover_url = null;
    $ebook_url = null;

    //Folder tujuan untuk menyimpan cover dan ebook yang diupload
    $cover_upload_to = 'files/covers/';
    $ebook_upload_to = 'files/ebooks/';
    //Ambil nama file cover dan ebook yang diupload
    $cover_filename = $_FILES['cover_url']['name'];
    $ebook_filename = $_FILES['ebook_url']['name'];
    //Mengambil nama file temp cover dan ebook
    $cover_tmp_filename = $_FILES['cover_url']['tmp_name'];
    $ebook_tmp_filename = $_FILES['ebook_url']['tmp_name'];
    //Direktori + Nama File Cover dan Ebook
    $cover_url = $cover_upload_to . $cover_filename;
    $ebook_url = $ebook_upload_to . $ebook_filename;

    $coverUploaded = move_uploaded_file($cover_tmp_filename, $cover_url);
    $ebookUploaded = move_uploaded_file($ebook_tmp_filename, $ebook_url);


    if ($coverUploaded && $ebookUploaded) {
        $author_id = $_POST['author_id'];
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $total_pages = $_POST['total_pages'];
        $rating = $_POST['rating'];

        $book = new Book(
            null,
            $author_id,
            $isbn,
            $title,
            $total_pages,
            $rating,
            $ebook_url,
            $cover_url,
            0
        );

        BooksDB::create($book);

        header('Location: books.php');
    } else {
        echo '<div class="alert alert-danger mt-5" role="alert">
                Error: Failed to upload cover or ebook
              </div>';
    }
}
?>

<section class="py-1 text-center container">
    <div class="row">
        <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
            Books
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
                        <option value="<?php echo $author->getAuthorId(); ?>">
                            <?php echo $author->getAuthorName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inp_isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" maxlength="13" id="inp_isbn" name="isbn">
            </div>
            <div class="mb-3">
                <label for="inp_title" class="form-label">Title</label>
                <input type="text" class="form-control" id="inp_title" name="title">
            </div>
            <div class="mb-3">
                <label for="inp_total_pages" class="form-label">Total Pages</label>
                <input type="number" class="form-control" id="inp_total_pages" name="total_pages">
            </div>
            <div class="mb-3">
                <label for="inp_rating" class="form-label">Rating</label>
                <input type="number" class="form-control" min=1 max=5 step="0.1" id="inp_rating" name="rating">
            </div>
            <div class="mb-3">
                <label for="inp_cover_url" class="form-label">Upload cover</label>
                <input class="form-control" type="file" id="inp_cover_url" name="cover_url">
            </div>
            <div class="mb-3">
                <label for="inp_ebook_url" class="form-label">Upload e-book</label>
                <input class="form-control" type="file" id="inp_ebook_url" name="ebook_url">
            </div>
            <button type="submit" class="btn btn-primary">Add New Book</button>
        </form>
    </div>
</div>

<?php include('templates/footer.php'); ?>