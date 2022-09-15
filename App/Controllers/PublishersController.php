<?php

namespace App\Controllers;

use App\Models\Resource\PublishersResource;

class PublishersController extends AbstractController
{
    public function execute()
    {
        $publishersResource = new PublishersResource();
        $publishersModel = $publishersResource->executeQuery();

        $this->commonExecute('publishers', $publishersModel);
    }
}
