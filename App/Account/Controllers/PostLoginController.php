<?php

namespace App\Account\Controllers;

use App\Core\Controllers\AbstractController;

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

            return null;
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
