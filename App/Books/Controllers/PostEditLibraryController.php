<?php

namespace App\Books\Controllers;

use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Books\Models\Resource\LibrariesResource;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class PostEditLibraryController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        LibrariesResource $resource
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
