<?php

namespace App\Controllers;

use App\Blocks\LibraryBlock;
use App\Models\Resource\Environment;
use App\Models\Resource\LibrariesResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class LibraryController extends AbstractController
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
        $this->renderPage('library', $this->block, $libraryModel);
    }
}
