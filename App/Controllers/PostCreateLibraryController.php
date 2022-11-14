<?php

namespace App\Controllers;

use App\Models\Resource\Environment;
use App\Models\Resource\LibrariesResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostCreateLibraryController extends AbstractController
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

        $libraryModel = $this->resource->createLibrary(
            $this->getPostParam('libName'),
            $this->getPostParam('libAddress')
        );

        $this->redirect('library?id=' . $libraryModel->getId());
    }
}
