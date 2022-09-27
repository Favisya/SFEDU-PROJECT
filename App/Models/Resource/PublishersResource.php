<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AbstractModel;
use App\Models\PublishersModel;

class PublishersResource
{
    public function getPublishers(): AbstractModel
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT name, id from publishers;';
        $stmt  = $db->query($query);

        $publishersModel = new PublishersModel();
        $publishersModel->setData($stmt->fetchAll());

        return $publishersModel;
    }
}
