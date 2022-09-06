<?php

namespace App\Blocks;

use App\Database\Database;

class BooksBlock extends BlockAbstract
{
    protected $template = 'books';


    public function getData(): array
    {
        $db = Database::getInstance()->connectDB();

        $query = 'SELECT books.name, authors.name as author FROM books JOIN authors ON books.author_id = authors.id;';
        $stmt  = $db->query($query);

        $data = [];
        while ($row = $stmt->fetch())
        {
            $temp['name']   = $row['name'];
            $temp['author'] = $row['author'];

            $data[] = $temp;
        }

        return $data;
    }
}
