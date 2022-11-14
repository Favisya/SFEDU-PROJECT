<?php

namespace App\Controllers;

use App\Blocks\LibrariesBlock;
use App\Models\Resource\Environment;
use App\Models\Resource\LibrariesResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

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
