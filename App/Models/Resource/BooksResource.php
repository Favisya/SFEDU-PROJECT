<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;

class BooksResource
{
    public function executeQuery(int $id)
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

        return $stmt->fetchAll();
    }
}
