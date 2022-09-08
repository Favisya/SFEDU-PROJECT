<?php

namespace App\Blocks;

use App\Database\Database;

class AuthorBlock extends BlockAbstract
{
    private $data  = [];
    private $books = [];

    protected $template = 'author';

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from authors WHERE id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $this->data = $stmt->fetch();
    }

    public function setBooks($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT name, year FROM books  WHERE author_id = ? limit 3;';

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $this->books = $stmt->fetchAll();
    }

    public function getBooks()
    {
        return $this->books;
    }
}
