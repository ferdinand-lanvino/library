<?php
    include('templates/header.php');
    include_once('db/authors_db.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $author_name = $_POST['author_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $location = $_POST['location'];

        $author = new Author(null, $author_name, $date_of_birth, $location);
        AuthorsDB::create($author);
        header('Location: authors.php');
    }
?>

<section class="py-1 text-center container">
    <div class="row">
        <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
            Authors
        </h2>
    </div>
</section>

<div class="container">
    <div class="row">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="inp_author_name" class="form-label">Author Name</label>
                <input type="text" class="form-control" 
                    id="inp_author_name" name="author_name" >
            </div>
            <div class="mb-3">
                <label for="inp_dob">Start</label>
                <input type="date" class="form-control" 
                    id="inp_dob" name="date_of_birth"  />
            </div>
            <div class="mb-3">
                <label for="inp_location" class="form-label">Location</label>
                <input type="text" class="form-control" 
                    id="inp_location" name="location" >
            </div>
            <button type="submit" class="btn btn-primary">Add New Author</button>
        </form>
    </div>
</div>

<?php include('templates/footer.php'); ?>