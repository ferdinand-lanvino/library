<?php
include('templates/header.php');
include_once('db/authors_db.php');

$authors = AuthorsDB::all();
?>

<section class="py-1 text-center container">
    <div class="row">
        <h2 class="col-lg-6 col-md-8 mt-2 mx-auto">
            Authors
        </h2>
        <div class="col-lg-6 col-md-8 mx-auto mt-2">
            <a class="btn btn-primary" 
                href="authors_create.php">Add New</a>
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
                            <th scope="col">Author Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Location</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($authors as $author) : ?>
                            <tr>
                                <td><?= $author->getAuthorId() ?></td>
                                <td><?= $author->getAuthorName() ?></td>
                                <td><?= $author->getDateOfBirth() ?></td>
                                <td><?= $author->getLocation() ?></td>
                                <td>
                                    <a class="btn btn-primary" 
                                        href="authors_update.php?author_id=<?= $author->getAuthorId() ?>">Edit</a>
                                    <a class="btn btn-danger" 
                                        href="authors_delete.php?author_id=<?= $author->getAuthorId() ?>"
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