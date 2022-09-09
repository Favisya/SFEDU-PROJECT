<?php

namespace App\Models;

use App\Database\Database;

class LibraryModel extends ModelAbstract
{

    private $data  = [];
    private $books = [];

    public function getData(): array
    {   if (empty($this->data)) {
        return [null];
    }
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

    public function createLibrary(string $libraryName, string $libraryAddress)
    {
        if (!isset($libraryName, $libraryAddress)) {
            return false;
        }

        $libName     = htmlspecialchars($libraryName);
        $libAddress  = htmlspecialchars($libraryAddress);

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

    public function editLibrary(string $libraryName, string $libraryAddress , int $id): bool
    {
        if (!isset($libraryName,$libraryAddress, $id)) {
            return false;
        }

        $libraryName  = htmlspecialchars($libraryName);

        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE libraries SET name = ?, address = ? WHERE id = ?;';
        $stmt = $stmt->prepare($query);
        $stmt->execute([$libraryName, $libraryAddress,  $id]);

        header("Location: http://localhost:3000/library?id=$id");
        return true;
    }
}