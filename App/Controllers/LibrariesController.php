<?php

namespace App\Controllers;

use App\Models\Resource\LibrariesResource;

class LibrariesController extends AbstractController
{
    public function execute()
    {
        $librariesResource = $this->di->get(LibrariesResource::class);
        $librariesModel = $librariesResource->getLibraries();

        $this->renderPage('libraries', $librariesModel, 'LibrariesBlock');
    }
}
