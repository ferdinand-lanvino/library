<?php
include('templates/header.php');
include_once('db/authors_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_id = $_POST['author_id'];
    $author_name = $_POST['author_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $location = $_POST['location'];

    $author = new Author($author_id, $author_name, $date_of_birth, $location);
    AuthorsDB::update($author);
    header('Location: authors.php');
} else {
    // Kita tambahkan null coalescing operator untuk menghindari error
    $author_id = $_GET['author_id'] ?? '';
    $author = AuthorsDB::get($author_id);
}
?>

<?php if (isset($author)) : ?>

    <section class="py-1 text-center container">
        <div class="row">
            <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
                Edit Authors
            </h2>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <input type="hidden" name="author_id" 
                value="<?= $author->getAuthorId() ?>" />

                <div class="mb-3">
                    <label for="inp_author_name" class="form-label">Author Name</label>
                    <input type="text" class="form-control" id="inp_author_name" 
                    name="author_name" value="<?= $author->getAuthorName() ?>" />
                </div>
                <div class="mb-3">
                    <label for="inp_dob">Start</label>
                    <input type="date" class="form-control" id="inp_dob" 
                    name="date_of_birth" value="<?= $author->getDateOfBirth() ?>" />
                </div>
                <div class="mb-3">
                    <label for="inp_location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="inp_location" 
                    name="location" value="<?= $author->getLocation() ?>" />
                </div>
                <button type="submit" class="btn btn-primary">Update Author</button>
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