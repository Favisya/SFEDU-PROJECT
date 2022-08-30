<?php

namespace App\Router;

use App\Controllers;

class Router
{
    public function parseControllers (string $path): ?Controllers\ControllerInterface
    {
        switch ($path) {
            case '/': {
                echo 'Welcome to homepage';
                return null;
            }

            case '/authors': {
                return new Controllers\AuthorsController();
            }

            case '/books': {
                return new Controllers\BooksController();
            }

            case '/categories': {
                return new Controllers\CategoriesController();
            }

            case '/countries': {
                return new Controllers\CountriesController();
            }

            case '/libraries': {
                return new Controllers\LibrariesController();
            }

            case '/publishers': {
                return new Controllers\PublishersController();
            }

            case '/racks': {
                return new Controllers\RacksController();
            }

            default: {
                return new Controllers\Error404Controller();
            }
        }
    }
}
