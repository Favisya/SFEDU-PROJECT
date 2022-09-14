<?php

namespace App\Models;

use App\Database\Database;
use App\Exceptions\MvcException;

class LibraryModel extends ModelAbstract
{
    private $data  = [];
    private $books = [];

    public function getData(): ?array
    {
        return $this->data ?? null;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setBooks($data)
    {
        $this->books = $data;
    }

    public function executeQuery($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from libraries WHERE id = ?;';

        $stmtFirst = $db->prepare($query);
        $stmtFirst->execute([$id]);

        $data['info'] = $stmtFirst->fetch();

        if ($data['info'] === false) {
            throw new MvcException('Info not found');
        }

        $query = 'SELECT count(books_libraries.book_id) as count, books.name AS book
                  FROM books
                  JOIN books_libraries ON books.id = books_libraries.book_id
                  WHERE library_id = ? GROUP BY books.name LIMIT 3;';

        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id]);

        $data['books'] = $stmtSecond->fetchAll();

        return $data;
    }

    public function getBooks(): ?array
    {
        return $this->books ?? null;
    }

    public function createLibrary(string $name, string $address)
    {
        $libName     = htmlspecialchars($name);
        $libAddress  = htmlspecialchars($address);

        if (empty($name)  || empty($address)) {
            throw new MvcException('input is empty');
        }

        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'INSERT INTO libraries (name, address) values (?, ?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$libName, $libAddress]);

        $query      = 'SELECT id FROM libraries WHERE name = ? AND address = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$libName, $libAddress]);

        $id = $stmtSecond->fetch()['id'];

        header("Location: http://localhost:3000/library?id=$id");
        return true;
    }

    public function editLibrary(string $name, string $address, int $id): bool
    {
        $name     = htmlspecialchars($name);
        $address  = htmlspecialchars($address);

        if (!isset($name, $address)) {
            throw new MvcException('input is empty');
        }

        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE libraries SET name = ?, address = ? WHERE id = ?;';
        $stmt = $stmt->prepare($query);
        $stmt->execute([$name, $address,  $id]);

        header("Location: http://localhost:3000/library?id=$id");
        return true;
    }
}
