<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorModel;
use App\Models\AuthorsModel;
use App\Models\AbstractModel;

class AuthorsResource
{
    public function getAuthors(): AbstractModel
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM authors';

        $stmt = $db->query($query);

        $authorsModel = new AuthorsModel();

        $authors = [];
        foreach ($stmt->fetchAll() as $author) {
            $authorModel = new AuthorModel();
            $authorModel->setData($author);
            $authors[] = $authorModel;
        }
        $authorsModel->setData($authors);

        return $authorsModel;
    }
}
