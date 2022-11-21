<?php

return[
    'web_routes' => [
        'Book'              => \App\Books\Controllers\BookController::class,
        'Books'             => \App\Books\Controllers\BooksController::class,
        'Author'            => \App\Books\Controllers\AuthorController::class,
        'Authors'           => \App\Books\Controllers\AuthorsController::class,
        'Library'           => \App\Books\Controllers\LibraryController::class,
        'Libraries'         => \App\Books\Controllers\LibrariesController::class,
        'Countries'         => \App\Books\Controllers\CountriesController::class,
        'Publisher'         => \App\Books\Controllers\PublishersController::class,
        'Categories'        => \App\Books\Controllers\CategoriesController::class,
        'CreateBook'        => \App\Books\Controllers\CreateBookController::class,
        'CreateAuthor'      => \App\Books\Controllers\CreateAuthorController::class,
        'CreateLibrary'     => \App\Books\Controllers\CreateLibraryController::class,
        'DeleteBook'        => \App\Books\Controllers\DeleteBookController::class,
        'DeleteAuthor'      => \App\Books\Controllers\DeleteAuthorController::class,
        'DeleteLibrary'     => \App\Books\Controllers\DeleteLibraryController::class,
        'EditAuthor'        => \App\Books\Controllers\EditAuthorController::class,
        'EditBook'          => \App\Books\Controllers\EditBookController::class,
        'EditLibrary'       => \App\Books\Controllers\EditLibraryController::class,
        'PostCreateAuthor'  => \App\Books\Controllers\PostCreateAuthorController::class,
        'PostCreateLibrary' => \App\Books\Controllers\PostCreateLibraryController::class,
        'PostCreateBook'    => \App\Books\Controllers\PostCreateBookController::class,
        'PostEditAuthor'    => \App\Books\Controllers\PostEditAuthorController::class,
        'PostEditBook'      => \App\Books\Controllers\PostEditBookController::class,
        'PostEditLibrary'   => \App\Books\Controllers\PostEditLibraryController::class,
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
        'BooksDiC'  =>  \App\Books\Models\DiContainer\DiC::class,
    ],
];
