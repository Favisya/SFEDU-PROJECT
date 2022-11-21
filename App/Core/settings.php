<?php

return[
    'web_routes' => [
        ''           => \App\Core\Controllers\HomePageController::class,
        'error403'   => \App\Core\Controllers\Error403Controller::class,
        'error404'   => \App\Core\Controllers\Error404Controller::class,
        'error500'   => \App\Core\Controllers\Error500Controller::class,
        'Author'     => \App\Books\Controllers\AuthorController::class,
    ],

    'console_routes' => [
        'Books'      => \App\Books\Controllers\Console\BooksController::class,
        'ClearCache' => \App\Books\Controllers\Console\ClearCacheController::class,
        'NewBooks'   => \App\Books\Controllers\Console\NewBooksController::class,
    ],

    'api_routes' => [
      'Authors'     =>  \App\Books\Controllers\Api\AuthorsController::class,
      'Books'       =>  \App\Books\Controllers\Api\BooksController::class,
      'Libraries'   =>  \App\Books\Controllers\Api\LibrariesController::class,
    ],

    'di_containers' => [
        'CoreDiC'   => \App\Core\Models\DiContainer\DiC::class,
    ],
];
