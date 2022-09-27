<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\AuthorModel;
use App\Models\AbstractModel;

class AuthorResource
{
    public function getAuthor(int $id, int $limit = 3): AbstractModel
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

        $query = 'SELECT name, year FROM books WHERE author_id = ? limit ?';
        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id, $limit]);
        $data['books'] = $stmtSecond->fetchAll();

        $authorModel = new AuthorModel();
        $authorModel->setData($data['info']);
        $authorModel->setBooks($data['books']);

        return $authorModel;
    }

    public function createAuthor(string $authorName): AbstractModel
    {
        if (empty($authorName)) {
            throw new MvcException('Input is empty');
        }

        $authorName = htmlspecialchars($authorName);

        $db = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'INSERT INTO authors (name) values (?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$authorName]);

        $query = 'SELECT id FROM authors WHERE name = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$authorName]);

        $authorModel = new AuthorModel();
        $authorModel->setData($stmtSecond->fetch());

        return $authorModel;
    }

    public function editAuthor(string $authorName, int $id): AbstractModel
    {
        if (!isset($authorName, $id)) {
            throw new MvcException('Input is empty');
        }

        $authorName = htmlspecialchars($authorName);

        $db = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE authors SET name = ? WHERE id = ?;';
        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$authorName, $id]);

        $query = 'SELECT * FROM authors WHERE id = ?';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$id]);

        $authorModel = new AuthorModel();
        $authorModel->setData($stmtSecond->fetch());

        return $authorModel;
    }

    public function deleteAuthor(int $id): void
    {
        $db = Database::getInstance()->getConnection();

        $query = 'DELETE FROM books WHERE author_id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $query = 'DELETE FROM authors WHERE id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }
}
