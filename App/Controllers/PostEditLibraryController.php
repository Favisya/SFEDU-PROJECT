<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\Resource\LibraryResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostEditLibraryController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        LibraryResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $this->handleToken();
        $this->validateForm(['libAddress', 'libName']);

        $libraryModel = $this->resource->editLibrary(
            $this->getPostParam('libName'),
            $this->getPostParam('libAddress'),
            $this->getParam('id')
        );
        $this->redirect('library?id=' . $libraryModel->getId());
    }
}
