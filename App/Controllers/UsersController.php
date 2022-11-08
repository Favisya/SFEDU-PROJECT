<?php

namespace App\Controllers;

use App\Models\Resource\UsersResource;

class UsersController extends AbstractController
{
    public function execute()
    {
        $resource = $this->di->get(UsersResource::class);
        $model = $resource->getUsers();

        $this->renderPage('users', $model, 'UsersBlock');
    }
}
