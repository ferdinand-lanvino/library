<?php
    include('templates/header.php');
    include_once('db/books_db.php');

    // Kita tambahkan null coalescing operator untuk menghindari error
    $book_id = $_GET['book_id'] ?? '';
    $book = BooksDB::get($book_id);

    if (isset($book)) {
        unlink($book->getCoverUrl());//Hapus File Cover
        unlink($book->getEbookUrl());//Hapus File Ebook
        BooksDB::delete($book_id);

        header('Location: books.php');
    }
?>

<?php if(!isset($book)): ?>

<section class="py-1 text-center container">
    <div class="row">
        <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
            Book Not Found
        </h2>
        <a class="btn btn-primary" href="books.php">Back</a>
    </div>
</section>

<?php endif; ?>

<?php include('templates/footer.php'); ?>