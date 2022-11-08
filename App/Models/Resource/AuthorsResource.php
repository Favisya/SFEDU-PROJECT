<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorModel;
use App\Models\AuthorsModel;
use App\Models\AbstractModel;

class AuthorsResource extends AbstractResource
{
    public function getAuthors(): AbstractModel
    {
        $db = $this->di->get(Database::class);
        $db = $db->getConnection();

        $query = 'SELECT * FROM authors';

        $stmt = $db->query($query);

        $authorsModel = $this->di->get(AuthorsModel::class);

        $authors = [];
        foreach ($stmt->fetchAll() as $author) {
            $authorModel = $this->di->newInstance(AuthorModel::class);
            $authorModel->setData($author);
            $authors[] = $authorModel;
        }
        $authorsModel->setData($authors);

        return $authorsModel;
    }
}
