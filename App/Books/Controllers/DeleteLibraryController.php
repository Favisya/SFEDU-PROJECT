<?php

namespace App\Books\Controllers;

use App\Core\Models\Resource\Environment;
use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\LibrariesResource;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class DeleteLibraryController extends AbstractController
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
        $this->resource->deleteLibrary($this->getParam('id'));
        $this->redirect('libraries');
    }
}
