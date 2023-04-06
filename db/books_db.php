<?php 
include_once(__DIR__.'/connection.php');
include_once(__DIR__.'/../models/book.php');

class BooksDB extends Connection
{
    public static function all()
    {
        $books = self::executeQuery("SELECT * FROM books");
        $booksArr = [];
        foreach ($books as $author) {
            $booksArr[] = new Book(
                $author['book_id'],
                $author['author_id'], 
                $author['isbn'], 
                $author['title'], 
                $author['total_pages'], 
                $author['rating'], 
                $author['ebook_url'], 
                $author['cover_url'], 
                $author['total_views']
            );
        }
        return $booksArr;
    }

    public static function get($book_id)
    {
        $books = self::executeQuery("SELECT * FROM books WHERE book_id = ?", array($book_id));
        $book = null;
        if (count($books) > 0) {
            $book = new Book(
                $books[0]['book_id'],
                $books[0]['author_id'], 
                $books[0]['isbn'], 
                $books[0]['title'], 
                $books[0]['total_pages'], 
                $books[0]['rating'], 
                $books[0]['ebook_url'], 
                $books[0]['cover_url'], 
                $books[0]['total_views']
            );
        }
        return $book;
    }

    public static function updateTotalViews($book_id)
    {
        $sql = "UPDATE books SET total_views = total_views + 1 WHERE book_id = ?";
        $params = array($book_id);
        return self::executeQuery($sql, $params);
    }

    public static function create(Book $book)
    {
        $sql = "INSERT INTO books (author_id, isbn, title, total_pages, rating, ebook_url, cover_url, total_views) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($book->getAuthorId(), $book->getIsbn(), $book->getTitle(), $book->getTotalPages(), $book->getRating(), $book->getEbookUrl(), $book->getCoverUrl(), $book->getTotalViews());
        return self::executeQuery($sql, $params);
    }

    public static function update(Book $book)
    {
        $sql = "UPDATE books SET author_id = ?, isbn = ?, title = ?, total_pages = ?, rating = ?, ebook_url = ?, cover_url = ?, total_views = ? WHERE book_id = ?";
        $params = array($book->getAuthorId(), $book->getIsbn(), $book->getTitle(), $book->getTotalPages(), $book->getRating(), $book->getEbookUrl(), $book->getCoverUrl(), $book->getTotalViews(), $book->getBookId());
        return self::executeQuery($sql, $params);
    }

    public static function delete($book_id)
    {
        $sql = "DELETE FROM books WHERE book_id = ?";
        $params = array($book_id);
        return self::executeQuery($sql, $params);
    }
    
}
