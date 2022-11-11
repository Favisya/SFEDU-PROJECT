<?php

namespace App\Controllers;

use App\Blocks\CategoriesBlock;
use App\Models\Resource\CategoriesResource;
use App\Models\Resource\Environment;
use App\Models\Resource\LoginResource;
use App\Models\SessionModel;
use App\Models\TokenModel;

class PostLoginController extends AbstractController
{
    public function execute()
    {
        $this->handleToken();

        $this->service->setResource($this->resource);

        if (!$this->isUserExist()) {
            $session = $this->session;
            $session->setError('Неправильный логин или пароль');
            $this->redirect('login');
        }

        $this->redirect('profile');
    }

    protected function isUserExist(): bool
    {
        return $this->service->authenticate(
            $this->getPostParam('login'),
            $this->getPostParam('password')
        );
    }
}
