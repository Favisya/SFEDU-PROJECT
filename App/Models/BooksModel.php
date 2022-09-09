<?php

namespace App\Models;

use App\Database\Database;

class BooksModel extends ModelAbstract
{
    private $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(int $id)
    {
        $db = Database::getInstance()->getConnection();

        if ($id === 0) {
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