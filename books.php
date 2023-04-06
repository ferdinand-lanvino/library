<?php
include('templates/header.php');
include_once('db/books_db.php');

$books = BooksDB::all();
?>

<section class="py-1 text-center container">
    <div class="row">
        <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
            Books
        </h2>
        <div class="col-lg-6 col-md-8 mx-auto mt-2">
            <a class="btn btn-primary" href="books_create.php">Add New</a>
        </div>
    </div>
</section>

<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-lg">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Author</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Views</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book) : ?>
                            <tr>
                                <td><?= $book->getBookId() ?></td>
                                <td>
                                    <div><?= $book->getTitle() ?></div>
                                    <small><?= $book->getTotalPages() ?> Pages</small>
                                </td>
                                <td><?= $book->getIsbn() ?></td>
                                <td><?= $book->getRating() ?></td>

                                <?php
                                    include_once('db/authors_db.php');
                                    $authorId = $book->getAuthorId();
                                    $authorName =  AuthorsDB::get($authorId)->getAuthorName();
                                ?>
                                <td><?= $authorName ?></td>
                                
                                <td><?= $book->getTotalViews() ?></td>
                                <td>
                                    <a class="btn btn-primary" 
                                        href="books_update.php?book_id=<?= $book->getBookId() ?>">Edit</a>
                                    <a class="btn btn-danger" 
                                        href="books_delete.php?book_id=<?= $book->getBookId() ?>" 
                                        onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>