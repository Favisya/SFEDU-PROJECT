<?php

return[
    'web_routes' => [
        'EditUser'              => \App\Account\Controllers\EditUserController::class,
        'Login'                 => \App\Account\Controllers\LoginController::class,
        'LogOut'                => \App\Account\Controllers\LogOutController::class,
        'PostEditUser'          => \App\Account\Controllers\PostEditUserController::class,
        'PostLogin'             => \App\Account\Controllers\PostLoginController::class,
        'PostRegistration'      => \App\Account\Controllers\PostRegistrationController::class,
        'Profile'               => \App\Account\Controllers\ProfileController::class,
        'Registration'          => \App\Account\Controllers\RegistrationController::class,
        'SendMail'              => \App\Account\Controllers\SendMailController::class,
        'TakeBook'              => \App\Account\Controllers\TakeBookController::class,
        'TookenBooks'           => \App\Account\Controllers\TookenBooksController::class,
        'User'                  => \App\Account\Controllers\UserController::class,
        'Users'                 => \App\Account\Controllers\UsersController::class,
    ],

    'console_routes' => [
        'SendMail'      => \App\Books\Controllers\Console\BooksController::class,
    ],

    'api_routes' => [],
];