<?php

namespace App\Books\Controllers;

use App\Core\Controllers\AbstractController;
use App\Books\Blocks\LibraryBlock;
use App\Core\Models\Resource\Environment;
use App\Books\Models\Resource\LibrariesResource;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class EditLibraryController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        LibraryBlock $block,
        LibrariesResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $libraryModel = $this->resource->getLibrary($this->getParam('id'));
        $this->renderPage('createLibrary', $this->block, $libraryModel);
    }
}
