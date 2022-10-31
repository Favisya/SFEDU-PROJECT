<?php

namespace App\Controllers;

use App\Models\Resource\UsersResource;

class UsersController extends AbstractController
{
    public function execute()
    {
        $resource = new UsersResource();
        $model = $resource->getUsers();

        $this->commonExecute('users', $model, 'UsersBlock');
    }
}
