<?php
class Book
{
	private $book_id;
	private $author_id;
	private $isbn;
	private $title;
	private $total_pages;
	private $rating;
	private $ebook_url;
	private $cover_url;
	private $total_views;

	public function __construct($book_id, $author_id, $isbn, $title, $total_pages, $rating, $ebook_url, $cover_url, $total_views)
	{
		$this->book_id = $book_id;
		$this->author_id = $author_id;
		$this->isbn = $isbn;
		$this->title = $title;
		$this->total_pages = $total_pages;
		$this->rating = $rating;
		$this->ebook_url = $ebook_url;
		$this->cover_url = $cover_url;
		$this->total_views = $total_views;
	}

	public function getBookId()
	{
		return $this->book_id;
	}

	public function getAuthorId()
	{
		return $this->author_id;
	}

	public function getIsbn()
	{
		return $this->isbn;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getTotalPages()
	{
		return $this->total_pages;
	}

	public function getRating()
	{
		return $this->rating;
	}

	public function getEbookUrl()
	{
		return $this->ebook_url;
	}

	public function getCoverUrl()
	{
		return $this->cover_url;
	}

	public function getTotalViews()
	{
		return $this->total_views;
	}
}
