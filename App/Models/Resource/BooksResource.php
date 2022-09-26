<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\BooksModel;
use App\Models\AbstractModel;

class BooksResource
{
    public function executeQuery(int $id): AbstractModel
    {
        if (!isset($id)) {
            throw new MvcException('Id is wrong');
        }

        $db = Database::getInstance()->getConnection();

        $query = 'SELECT books.id, books.name, authors.name as author FROM books
            JOIN authors ON books.author_id = authors.id';

        if ($id === 0) {
            $stmt = $db->query($query);
        } else {
            $query .= ' where books.author_id = ?;';

            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
        }

        $booksModel = new BooksModel();
        $booksModel->setData($stmt->fetchAll());

        return $booksModel;
    }

    public function getTookenBooks(int $user_id)
    {
        if (!isset($user_id)) {
            throw new MvcException('Id is wrong');
        }

        $db = Database::getInstance()->getConnection();

        $query = 'SELECT books.id, books.name FROM books
            JOIN books_users ON books.id = books_users.book_id
            WHERE user_id = ?';

        $stmt = $db->prepare($query);
        $stmt->execute([$user_id]);

        $booksModel = new BooksModel();
        $booksModel->setData($stmt->fetchAll());

        return $booksModel;
    }
}
