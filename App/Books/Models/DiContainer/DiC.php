<?php

namespace App\Books\Models\DiContainer;

use App\Core\Controllers\Error404Controller;
use App\Core\Models\DiContainer\AbstractDiC;
use App\Core\Models\Resource\Environment;
use App\Core\Router\ApiRouter;
use App\Core\Router\ConsoleRouter;
use App\Core\Router\Router;

class DiC extends AbstractDiC
{
    protected function assembleBooksResources()
    {
        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\AuthorsResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\BooksResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\CategoriesResource::class,
            ['di' => $this->di]
        );
        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\CountriesResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\LibrariesResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\PublishersResource::class,
            ['di' => $this->di]
        );

        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\RegistrationResource::class,
            ['di' => $this->di]
        );


        $this->instanceManager->setParameters(
            \App\Books\Models\Resource\UpdateBooksResource::class,
            ['di' => $this->di]
        );
    }

    protected function assembleWebBooksControllers()
    {
        $this->instanceManager->setParameters(
            \App\Books\Controllers\CreateAuthorController::class,
            [
                'block'    => $this->di->get(\App\Books\Blocks\AuthorBlock::class),
                'model'    => $this->di->get(\App\Books\Models\AuthorModel::class),
            ]
        );

        $this->instanceManager->setParameters(
            \App\Books\Controllers\CreateLibraryController::class,
            [
                'model'     => $this->di->get(\App\Books\Models\LibraryModel::class),
                'block'     => $this->di->get(\App\Books\Blocks\LibraryBlock::class),
            ]
        );
    }
}
