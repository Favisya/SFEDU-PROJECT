<?php

namespace App\Controllers;

use App\Blocks\LibraryBlock;
use App\Models\Resource\Environment;
use App\Models\Resource\LibraryResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class EditLibraryController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        LibraryBlock $block,
        LibraryResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $libraryModel = $this->resource->getLibrary($this->getParam('id'));
        $this->renderPage('createLibrary', $this->block, $libraryModel);
    }
}
