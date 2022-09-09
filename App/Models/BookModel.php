<?php

namespace App\Models;

use App\Database\Database;

class BookModel extends ModelAbstract
{
    private $data = [];
    private $libs = [];

    public function getData(): array
    {   if (empty($this->data)) {
        return [null];
    }
        return $this->data;
    }

    public function getLibs(): array
    {
        return $this->libs;
    }

    public function setData($id)
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT
                    a.name AS book_name,
                    a.author_id,
                    a.price AS book_price,
                    a.year AS book_date,
                    b.name AS author,
                    c.name AS publisher,
                    d.name AS country
                  FROM books AS a 
                  JOIN authors AS b ON a.author_id = b.id
                  JOIN publishers AS c ON a.publisher_id = c.id
                  JOIN countries AS d ON a.country_id = d.id
                  WHERE a.id = ?;';

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $this->data = $stmt->fetch();
    }

    public function setLibs(int $id)
    {
        $query = 'SELECT count(books_libraries.book_id) as count,libraries.name AS library, libraries.id AS id
                  FROM libraries
                  JOIN books_libraries ON libraries.id = books_libraries.library_id
                  WHERE books_libraries.book_id = ? GROUP BY id LIMIT 6;';

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $this->libs = $stmt->fetchAll();
    }


    public function createBook(string $bookName,
                               int $price,
                               int $authorId,
                               int $countryId,
                               int $publisherId,
                               string $date): bool {
        if (!isset($bookName,
                   $price,
                   $authorId,
                   $countryId,
                   $publisherId,
                   $date)) {
            return false;
        }

        $bookName     = htmlspecialchars($bookName);
        $price        = htmlspecialchars($price);
        $authorId     = htmlspecialchars($authorId);
        $countryId    = htmlspecialchars($countryId);
        $publisherId  = htmlspecialchars($publisherId);
        $date         = htmlspecialchars($date);


        $db   = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'INSERT INTO books (name, price, year, author_id, publisher_id, country_id) VALUES (?, ?, ?, ?, ?, ?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$bookName, $price, $date, $authorId, $publisherId, $countryId]);

        $query = 'SELECT id FROM books WHERE name = ? AND author_id = ? AND publisher_id = ? LIMIT 1;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$bookName, $authorId, $publisherId]);

        $id = $stmtSecond->fetch()['id'];
        header("Location: http://localhost:3000/book?id=$id");
        return true;
    }
}