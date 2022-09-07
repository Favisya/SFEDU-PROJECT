<?php

namespace App\Blocks;

use App\Database\Database;

class BooksBlock extends BlockAbstract
{
    private $data = [];

    protected $template = 'books';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($id)
    {
        $db = Database::getInstance()->getConnection();

        if (!isset($id)) {
            $query = 'SELECT books.id, books.name, authors.name as author FROM books
            JOIN authors ON books.author_id = authors.id;';

            $stmt = $db->query($query);
        } else {
            $query = 'SELECT books.id, books.name, authors.name as author FROM books
                      JOIN authors ON books.author_id = authors.id where books.author_id = ?;';

            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
        }

        $this->data = $stmt->fetchAll();
    }
}
