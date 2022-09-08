<?php

namespace App\Blocks;

use App\Database\Database;

class LibraryBlock extends BlockAbstract
{
    private $data  = [];
    private $books = [];

    protected $template = 'library';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from libraries WHERE id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$_GET['id']]);

        $this->data = $stmt->fetch();
    }

    public function setBooks($id)
    {
        $query = 'SELECT count(books_libraries.book_id) as count, books.name AS book
                  FROM books
                  JOIN books_libraries ON books.id = books_libraries.book_id
                  WHERE books.author_id = ? GROUP BY books.name LIMIT 4;';

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $this->books = $stmt->fetchAll();
    }

    public function getBooks(): array
    {
        return $this->books;
    }
}
