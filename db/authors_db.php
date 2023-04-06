<?php 
include_once(__DIR__.'/connection.php');
include_once(__DIR__.'/../models/author.php');

class AuthorsDB extends Connection
{
    public static function all()
    {
        $authors = self::executeQuery("SELECT * FROM authors");
        $authorsArr = [];
        foreach ($authors as $author) {
            $authorsArr[] = new Author(
                $author['author_id'],
                $author['author_name'],
                $author['date_of_birth'],
                $author['location']
            );
        }
        return $authorsArr;
    }

    public static function get($author_id)
    {
        $authors = self::executeQuery("SELECT * FROM authors WHERE author_id = ?", array($author_id));
        $author = null;
        if (count($authors) > 0) {
            $author = new Author(
                $authors[0]['author_id'],
                $authors[0]['author_name'],
                $authors[0]['date_of_birth'],
                $authors[0]['location']
            );
        }
        return $author;
    }

    public static function create(Author $author)
    {
        $sql = "INSERT INTO authors (author_name, date_of_birth, location) VALUES (?, ?, ?)";
        $params = array($author->getAuthorName(), $author->getDateOfBirth(), $author->getLocation());
        return self::executeQuery($sql, $params);
    }

    public static function update(Author $author)
    {
        $sql = "UPDATE authors SET author_name = ?, date_of_birth = ?, location = ? WHERE author_id = ?";
        $params = array($author->getAuthorName(), $author->getDateOfBirth(), $author->getLocation(), $author->getAuthorId());
        return self::executeQuery($sql, $params);
    }

    public static function delete($author_id)
    {
        $sql = "DELETE FROM authors WHERE author_id = ?";
        $params = array($author_id);
        return self::executeQuery($sql, $params);
    }

    
}
