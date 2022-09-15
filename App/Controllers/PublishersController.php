<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\PublishersModel;
use App\Models\Resource\PublishersResource;

class PublishersController extends AbstractController
{
    public function execute()
    {
        $publishersModel = new PublishersModel();
        $publishersResource = new PublishersResource();

        $data = $publishersResource->executeQuery();
        $publishersModel->setData($data);

        $this->commonExecute('publishers', $publishersModel);
    }
}
