<?php

namespace App\Controllers;

use App\Blocks\AuthorsBlock;
use App\Models\AuthorModel;
use App\Models\Resource\BookResource;
use App\Models\SessionModel;
use Laminas\Di\Di;

class CreateAuthorController extends AbstractController
{
    public function __construct(Di $di, BookResource $resource, AuthorsBlock $block, AuthorModel $model)
    {
        parent::__construct($di, $resource, $block, $model);
    }

    public function execute()
    {
        $this->renderPage('createAuthor', $this->model, $this->block);
    }
}
