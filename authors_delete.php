<?php
    include('templates/header.php');
    include_once('db/authors_db.php');

    // Kita tambahkan null coalescing operator untuk menghindari error
    $author_id = $_GET['author_id'] ?? '';
    $author = AuthorsDB::get($author_id);

    if (isset($author)) {
        AuthorsDB::delete($author_id);
        header('Location: authors.php');
    }
?>

<?php if(!isset($author)): ?>

<section class="py-1 text-center container">
    <div class="row">
        <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
            Author Not Found
        </h2>
        <a class="btn btn-primary" href="authors.php">Back</a>
    </div>
</section>

<?php endif; ?>

<?php include('templates/footer.php'); ?>