<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;

class AuthorResource
{
    public function executeQuery(int $id): array
    {
        if ($id == 0 || $id < 0 || !isset($id)) {
            throw new MvcException('id is wrong');
        }
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * FROM authors WHERE id = ?';
        $stmtFirst = $db->prepare($query);
        $stmtFirst->execute([$id]);
        $data['info'] = $stmtFirst->fetch();

        if ($data['info'] === false) {
            throw new MvcException('Info not found');
        }

        $query = 'SELECT name, year FROM books WHERE author_id = ? limit 3';
        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id]);
        $data['books'] = $stmtSecond->fetchAll();

        return $data;
    }

    public function createAuthor(string $authorName): bool
    {
        if (empty($authorName)) {
            throw new MvcException('Input is empty');
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
            throw new MvcException('Input is empty');
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
