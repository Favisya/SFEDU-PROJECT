<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\LibrariesModel;
use App\Models\LibraryModel;

class LibraryResource
{
    public function executeQuery(int $id, int $limit = 3): LibraryModel
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
                  WHERE library_id = ? GROUP BY books.name LIMIT ?;';

        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id, $limit]);

        $data['books'] = $stmtSecond->fetchAll();

        $libraryModel = new LibraryModel();
        $libraryModel->setData($data['info']);
        $libraryModel->setBooks($data['books']);

        return $libraryModel;
    }

    public function createLibrary(string $name, string $address): LibraryModel
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

        $query      = 'SELECT * FROM libraries WHERE name = ? AND address = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$libName, $libAddress]);

        $libraryModel = new LibraryModel();
        $libraryModel->setData($stmtSecond->fetch());

        return $libraryModel;
    }

    public function editLibrary(string $name, string $address, int $id): LibraryModel
    {
        $name     = htmlspecialchars($name);
        $address  = htmlspecialchars($address);

        if (!isset($name, $address)) {
            throw new MvcException('input is empty');
        }

        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE libraries SET name = ?, address = ? WHERE id = ?;';
        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$name, $address,  $id]);

        $query      = 'SELECT * FROM libraries WHERE name = ? AND address = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$name, $address]);

        $libraryModel = new LibraryModel();
        $libraryModel->setData($stmtSecond->fetch());

        return $libraryModel;
    }
}
