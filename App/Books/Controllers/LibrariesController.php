<?php

namespace App\Books\Controllers;

use App\Books\Blocks\LibrariesBlock;
use App\Core\Models\Resource\Environment;
use App\Core\Controllers\AbstractController;
use App\Books\Models\Resource\LibrariesResource;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class LibrariesController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        LibrariesBlock $block,
        LibrariesResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource, $block);
    }

    public function execute()
    {
        $librariesModel = $this->resource->getLibraries();
        $this->renderPage('libraries', $this->block, $librariesModel);
    }
}
