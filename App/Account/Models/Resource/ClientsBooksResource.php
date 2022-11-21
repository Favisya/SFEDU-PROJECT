<?php

namespace App\Account\Models\Resource;

use App\Books\Models\BookModel;
use App\Books\Models\BooksModel;
use App\Core\Exceptions\MvcException;
use App\Core\Models\Resource\AbstractResource;

class ClientsBooksResource extends AbstractResource
{
    public function takeBook(int $book_id, int $user_id): void
    {
        $db = $this->database->getConnection();

        $query = 'INSERT INTO books_users (book_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $stmt->execute([$book_id, $user_id]);
    }

    public function getTookenBooks(int $user_id)
    {
        if (!isset($user_id)) {
            throw new MvcException('Id is wrong');
        }

        $db = $this->database->getConnection();

        $query = 'SELECT books.id, books.name FROM books
            JOIN books_users ON books.id = books_users.book_id
            WHERE user_id = ?';

        $stmt = $db->prepare($query);
        $stmt->execute([$user_id]);

        $books = [];
        foreach ($stmt->fetchAll() as $book) {
            $bookModel = $this->di->newInstance(BookModel::class);
            $bookModel->setData($book);
            $books[] = $bookModel;
        }

        $booksModel = $this->di->get(BooksModel::class);
        $booksModel->setData($books);

        return $booksModel;
    }
}
