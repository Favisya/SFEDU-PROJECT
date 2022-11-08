<?php

namespace App\Controllers;

use App\Blocks\AbstractBlock;
use App\Blocks\AuthorBlock;
use App\Models\Resource\AbstractResource;
use App\Models\Resource\AuthorResource;
use Laminas\Di\Di;

class AuthorController extends AbstractController
{
    public function __construct(Di $di, AbstractResource $resource, AbstractBlock $block)
    {
        parent::__construct($di, $resource, $block);
    }

    public function execute()
    {
        $authorResource = $this->resource;
        $authorModel = $authorResource->getAuthor($this->getParam('id'));

        $this->renderPage('author', $authorModel, $this->block);
    }
}
