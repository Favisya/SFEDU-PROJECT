<?php

namespace App\Models;

use App\Database\Database;
use App\Exceptions\MvcException;

class BookModel extends ModelAbstract
{
    private $data = [];
    private $libs = [];

    public function getData(): ?array
    {
        return $this->data ?? null;
    }

    public function getLibs(): ?array
    {
        return $this->libs ?? null;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setLibs(array $data)
    {

        $this->libs = $data;
    }

    public function executeQuery(int $id)
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
                  WHERE books_libraries.book_id = ? GROUP BY id LIMIT 6;';

        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id]);

        $data['books'] = $stmtSecond->fetchAll();

        return $data;
    }

    public function createBook(
        string $name,
        string $date,
        int $price,
        int $authorId,
        int $countryId,
        int $publisherId,
        int $categoryId
    ): bool {
        $name = htmlspecialchars($name);
        $price = htmlspecialchars($price);
        $authorId = htmlspecialchars($authorId);
        $countryId = htmlspecialchars($countryId);
        $publisherId = htmlspecialchars($publisherId);
        $date = htmlspecialchars($date);
        $categoryId = htmlspecialchars($categoryId);

        if (
            empty($name)
            || empty($price)
            || empty($authorId)
            || empty($countryId)
            || empty($publisherId)
            || empty($date)
            || empty($categoryId)
        ) {
            throw new MvcException('Input is empty');
        }

        $db = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'INSERT INTO books (name, price, year, author_id, publisher_id, country_id) VALUES (?, ?, ?, ?, ?, ?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$name, $price, $date, $authorId, $publisherId, $countryId]);

        $query = 'SELECT id FROM books WHERE name = ? AND author_id = ? AND publisher_id = ? LIMIT 1;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$name, $authorId, $publisherId]);

        $id = $stmtSecond->fetch()['id'];

        $query = 'INSERT INTO books_categories (book_id, category_id) VALUES (?, ?)';

        $stmtThird = $stmt->prepare($query);
        $stmtThird->execute([$id, $categoryId]);

        header("Location: http://localhost:3000/book?id=$id");
        return true;
    }

    public function editBook(
        string $name,
        string $date,
        int $price,
        int $authorId,
        int $countryId,
        int $publisherId,
        int $categoryId,
        int $id
    ): bool {
        $name = htmlspecialchars($name);
        $price = htmlspecialchars($price);
        $authorId = htmlspecialchars($authorId);
        $countryId = htmlspecialchars($countryId);
        $publisherId = htmlspecialchars($publisherId);
        $date = htmlspecialchars($date);
        $categoryId = htmlspecialchars($categoryId);
        $id = htmlspecialchars($id);

        if (
            empty($name)
            || empty($price)
            || empty($authorId)
            || empty($countryId)
            || empty($publisherId)
            || empty($date)
            || empty($categoryId)
            || empty($id)
        ) {
            throw new MvcException('Input is empty');
        }

        $db = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE books SET
                 name = ?,
                 price = ?,
                 year = ?,
                 author_id = ?,
                 publisher_id = ?,
                 country_id = ?
                 where id = ?';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$name, $price, $date, $authorId, $publisherId, $countryId, $id]);

        $query = 'UPDATE books_categories  SET category_id = ? WHERE book_id = ?';

        $stmtThird = $stmt->prepare($query);
        $stmtThird->execute([$categoryId, $id]);

        header("Location: http://localhost:3000/book?id=$id");
        return true;
    }

    public function __toString()
    {
        $class = explode('\\', get_class());
        return $class = lcfirst(end($class));
    }
}
