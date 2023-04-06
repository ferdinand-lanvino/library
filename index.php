<?php
include('templates/header.php');
include_once('db/books_db.php');

$books = BooksDB::all();
?>

<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">BT Library</h1>
      <p class="lead text-muted">Unlimited Reading at Your Fingertips: Explore Our Vast Collection of eBooks Today!</p>
    </div>
  </div>
</section>

<div class="py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <?php foreach ($books as $book) : ?>
        <!-- Card Component -->
        <div class="col">
          <div class="card text-start">
            <img class="card-img-top" src="<?= $book->getCoverUrl() ?>" 
                 style="height:300px;object-fit:contain;" alt="Title">
            <div class="card-body">
              <h4 class="card-title"><?= $book->getTitle() ?></h4>
              <?php
                include_once('db/authors_db.php');
                $authorId = $book->getAuthorId();
                $authorName =  AuthorsDB::get($authorId)->getAuthorName();
              ?>
              <p class="card-text"><?= $authorName ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-outline-primary btn-block" 
                     href="reader.php?book_id=<?=$book->getBookId() ?>" >
                    Read
                  </a>
                </div>
                <small class="text-muted"><?= $book->getTotalViews() ?> View(s)</small>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Card Component -->
      <?php endforeach; ?>

    </div>
  </div>
</div>

<?php include('templates/footer.php'); ?>