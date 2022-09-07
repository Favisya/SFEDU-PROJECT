<?php

namespace App\Blocks;

use App\Database\Database;

class BookBlock extends BlockAbstract
{
    private $data = [];
    private $libs = [];

    protected $template = 'book';

    public function getData(): array
    {
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

    public function setLibs($id)
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
}