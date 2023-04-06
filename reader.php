<?php
include('templates/header.php');
include_once('db/books_db.php');

// Kita tambahkan null coalescing operator untuk menghindari error
$book_id = $_GET['book_id'] ?? '';
$book = BooksDB::get($book_id);

BooksDB::updateTotalViews($book_id);
?>

<style>
    #pdf-js-viewer {
        height: 85vh;
    }
</style>

<?php if (isset($book)) : ?>

    <section class="py-1 text-center container">
        <div class="row">
            <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
                <?= $book->getTitle() ?>
            </h2>
            <div>
                <iframe id="pdf-js-viewer" src="<?= $book->getEbookUrl() ?>" title="webviewer" frameborder="0" width="100%">
                </iframe>
            </div>
        </div>
    </section>

<?php else : ?>

    <section class="py-1 text-center container">
        <div class="row">
            <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
                Book Not Found
            </h2>
        </div>
    </section>

<?php endif; ?>

<?php include('templates/footer.php'); ?>