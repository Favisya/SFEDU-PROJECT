<?php

namespace App\Models;

use App\Database\Database;

class AuthorModel extends ModelAbstract
{
    protected $data  = [];
    protected $books = [];

    public function getData(): array
    {   if (empty($this->data)) {
            return [null];
        }
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

    public function createAuthor(string $authorName): bool
    {
        if (!isset($authorName)) {
            return false;
        }

        $authorName  = htmlspecialchars($authorName);

        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'INSERT INTO authors (name) values (?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$authorName]);

        $query = 'SELECT id FROM authors WHERE name = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$authorName]);

        $id = $stmtSecond->fetch()['id'];

        header("Location: http://localhost:3000/author?id=$id");
        return true;
    }

    public function editAuthor(string $authorName, int $id): bool
    {
        if (!isset($authorName, $id)) {
            return false;
        }

        $authorName  = htmlspecialchars($authorName);

        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE authors SET name = ? WHERE id = ?;';
        $stmt = $stmt->prepare($query);
        $stmt->execute([$authorName, $id]);

        header("Location: http://localhost:3000/author?id=$id");
        return true;
    }
}