<?php

namespace App\Books\Models\Resource;

use App\Core\Models\Resource\AbstractResource;
use App\Core\Models\AbstractModel;
use App\Books\Models\PublishersModel;

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
