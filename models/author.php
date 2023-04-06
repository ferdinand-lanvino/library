<?php
class Author
{
    private $author_id;
    private $author_name;
    private $date_of_birth;
    private $location;

    public function __construct($author_id, $author_name, $date_of_birth, $location)
    {
        $this->author_id = $author_id;
        $this->author_name = $author_name;
        $this->date_of_birth = $date_of_birth;
        $this->location = $location;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
