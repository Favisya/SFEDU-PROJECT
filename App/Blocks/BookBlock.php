<?php

namespace App\Blocks;

use App\Database\Database;

class BookBlock extends BlockAbstract
{
    protected $template = 'book';

    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

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

        $stmtFirst = $db->prepare($query);
        $stmtFirst->execute([$_GET['id']]);

        $data = [];
        while ($row = $stmtFirst->fetch()) {
            $data['bookName']  = $row['book_name'];
            $data['authorId']  = $row['author_id'];
            $data['bookPrice'] = $row['book_price'];
            $data['bookDate']  = $row['book_date'];
            $data['author']    = $row['author'];
            $data['publisher'] = $row['publisher'];
            $data['country']   = $row['country'];
        }

        return $data;
    }

    public function getLibs(): array
    {

        $query = 'SELECT count(books_libraries.book_id) as count,libraries.name AS library, libraries.id AS id
                  FROM libraries
                  JOIN books_libraries ON libraries.id = books_libraries.library_id
                  WHERE books_libraries.book_id = ? GROUP BY id LIMIT 6;';

        $db = Database::getInstance()->connectDB();
        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$_GET['id']]);

        $data = [];
        while ($row = $stmtSecond->fetch()) {
            $data[] = [
                'count'   => $row['count'],
                'libName' => $row['library'],
                'id'      => $row['id'],
            ];
        }

        return $data;
    }
}
