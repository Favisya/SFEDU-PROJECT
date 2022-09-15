<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\BookModel;
use App\Models\ModelAbstract;

class BookResource
{
    public function executeQuery(int $id, int $limit = 6): ModelAbstract
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

        $query = 'SELECT count(books_libraries.book_id) as count,libraries.name AS library, libraries.id AS id
                  FROM libraries
                  JOIN books_libraries ON libraries.id = books_libraries.library_id
                  WHERE books_libraries.book_id = ? GROUP BY id LIMIT ?;';

        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id, $limit]);

        $data['books'] = $stmtSecond->fetchAll();

        $bookModel = new BookModel();
        $bookModel->setData($data['info']);
        $bookModel->setLibs($data['books']);

        return $bookModel;
    }
}
