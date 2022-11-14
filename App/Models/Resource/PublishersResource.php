<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AbstractModel;
use App\Models\PublishersModel;

class PublishersResource extends AbstractResource
{
    public function getPublishers(): AbstractModel
    {
        $db = $this->database->getConnection();

        $query = 'SELECT name, id from publishers;';
        $stmt  = $db->query($query);

        $publishersModel = $this->di->get(PublishersModel::class);
        $publishersModel->setData($stmt->fetchAll());

        return $publishersModel;
    }
}
