<?php

namespace App\Blocks;

use App\Database\Database;

class BooksBlock extends BlockAbstract
{
    protected $template = 'books';


    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

        if (!isset($_GET['author_id'])) {
            $query = 'SELECT books.id, books.name, authors.name as author FROM books
            JOIN authors ON books.author_id = authors.id;';

            $stmt = $db->query($query);
        } else {
            $query = 'SELECT books.id, books.name, authors.name as author FROM books
                      JOIN authors ON books.author_id = authors.id where books.author_id = ?;';

            $stmt = $db->prepare($query);
            $stmt->execute([$_GET['author_id']]);
        }

        $data = [];
        while ($row = $stmt->fetch()) {
            $temp['id']     = $row['id'];
            $temp['name']   = $row['name'];
            $temp['author'] = $row['author'];

            $data[] = $temp;
        }

        return $data;
    }
}
