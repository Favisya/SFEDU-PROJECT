<?php

namespace App\Controllers;

use App\Models\Resource\Environment;
use App\Models\Resource\LibraryResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class DeleteLibraryController extends AbstractController
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
        $this->resource->deleteLibrary($this->getParam('id'));
        $this->redirect('libraries');
    }
}
