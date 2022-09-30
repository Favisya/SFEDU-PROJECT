<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\BookModel;
use App\Models\AbstractModel;
use App\Models\LibraryModel;

class BookResource
{
    public function getBook(int $id, int $limit = 6): AbstractModel
    {
        if (!isset($id)) {
            throw new MvcException('id is wrong');
        }

        $db = Database::getInstance()->getConnection();

        $query = 'SELECT
                    a.id,
                    a.name,
                    a.author_id,
                    a.price,
                    a.year AS date,
                    b.name AS author,
                    c.name AS publisher,
                    d.name AS country
                  FROM books AS a 
                  JOIN authors AS b ON a.author_id = b.id
                  JOIN publishers AS c ON a.publisher_id = c.id
                  JOIN countries AS d ON a.country_id = d.id
                  WHERE a.id = ?;';

        $stmtFirst = $db->prepare($query);
        $stmtFirst->execute([$id]);
        $data['info'] = $stmtFirst->fetch();

        if ($data['info'] === false) {
            throw new MvcException('Info not found');
        }

        $query = 'SELECT count(books_libraries.book_id) as count, libraries.name AS name, libraries.id AS id
                  FROM libraries
                  JOIN books_libraries ON libraries.id = books_libraries.library_id
                  WHERE books_libraries.book_id = ? GROUP BY id LIMIT ?;';

        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id, $limit]);

        $libraries = [];
        foreach ($stmtSecond->fetchAll() as $library) {
            $libModel = new LibraryModel();
            $libModel->setData($library);
            $libraries[] = $libModel;
        }

        $bookModel = new BookModel();
        $bookModel->setData($data['info']);
        $bookModel->setLibs($libraries);

        return $bookModel;
    }

    public function deleteBook(int $id): void
    {
        $db = Database::getInstance()->getConnection();

        $query = 'DELETE FROM books WHERE id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

    public function takeBook(int $book_id, int $user_id): void
    {
        $db = Database::getInstance()->getConnection();

        $query = 'INSERT INTO books_users (book_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $stmt->execute([$book_id, $user_id]);
    }
}
