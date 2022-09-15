<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\PublishersModel;
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
