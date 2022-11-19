<?php

namespace App\Books\Models\Resource;

use App\Core\Exceptions\MvcException;
use App\Books\Models\AuthorModel;
use App\Books\Models\AuthorsModel;
use App\Books\Models\BookModel;
use App\Core\Models\Resource\AbstractResource;

class AuthorsResource extends AbstractResource
{
    public function getAuthors(): AuthorsModel
    {
        $db = $this->database->getConnection();

        $query = 'SELECT * FROM authors';

        $stmt = $db->query($query);

        $authorsModel = $this->di->get(AuthorsModel::class);

        $authors = [];
        foreach ($stmt->fetchAll() as $author) {
            $authorModel = $this->di->newInstance(AuthorModel::class);
            $authorModel->setData($author);
            $authors[] = $authorModel;
        }
        $authorsModel->setData($authors);

        return $authorsModel;
    }

    public function getAuthor(int $id, int $limit = 3): AuthorModel
    {
        if ($id == 0 || $id < 0 || !isset($id)) {
            throw new MvcException('id is wrong');
        }
        $db = $this->database->getConnection();

        $query = 'SELECT * FROM authors WHERE id = ?';
        $stmtFirst = $db->prepare($query);
        $stmtFirst->execute([$id]);
        $data['info'] = $stmtFirst->fetch();

        if ($data['info'] === false) {
            throw new MvcException('Info not found');
        }

        $query = 'SELECT name, year AS date FROM books WHERE author_id = ? limit ?';
        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id, $limit]);

        $books = [];
        foreach ($stmtSecond->fetchAll() as $book) {
            $bookModel = $this->di->get(BookModel::class);
            $bookModel->setData($book);
            $books[] = $bookModel;
        }

        $authorModel = $this->di->get(AuthorModel::class);
        $authorModel->setData($data['info']);
        $authorModel->setBooks($books);

        return $authorModel;
    }

    public function createAuthor(string $authorName): AuthorModel
    {
        if (empty($authorName)) {
            throw new MvcException('Input is empty');
        }

        $authorName = htmlspecialchars($authorName);

        $stmt = $this->database->getConnection();

        $query = 'INSERT INTO authors (name) values (?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$authorName]);

        $query = 'SELECT id, name FROM authors WHERE name = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$authorName]);

        $authorModel = new AuthorModel();
        $authorModel->setData($stmtSecond->fetch());

        return $authorModel;
    }

    public function editAuthor(string $authorName, int $id): AuthorModel
    {
        if (!isset($authorName, $id)) {
            throw new MvcException('Input is empty');
        }

        $authorName = htmlspecialchars($authorName);

        $db = $this->database->getConnection();
        $stmt = $db;

        $query = 'UPDATE authors SET name = ? WHERE id = ?;';
        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$authorName, $id]);

        $query = 'SELECT * FROM authors WHERE id = ?';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$id]);

        $authorModel = $this->di->get(AuthorModel::class);
        $authorModel->setData($stmtSecond->fetch());

        return $authorModel;
    }

    public function deleteAuthor(int $id): void
    {
        $db = $this->database->getConnection();

        $query = 'DELETE FROM books WHERE author_id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $query = 'DELETE FROM authors WHERE id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }
}
