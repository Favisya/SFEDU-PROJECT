<?php

namespace App\Router;

use App\Controllers;
use App\Models\SessionModel;

class Router extends AbstractRouter
{
    public function parseControllers(string $path): ?Controllers\AbstractController
    {
        $session = $this->di->get(SessionModel::class);
        $session->runSession();

        $sessionId = $session->getUserId();

        $uri = $this->handleUri($path);

        $isMethodPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $isMethodGet  = $_SERVER['REQUEST_METHOD'] === 'GET';
        $isPostRegistration = stripos($uri, 'postRegistration');
        $isCreate = stripos($uri, 'create');
        $isEdit   = stripos($uri, 'edit');
        $isLogin  = stripos($uri, 'postLogin');

        if ($uri == '') {
            return $this->di->get(Controllers\HomePageController::class);
        }

        if ($uri == 'registration') {
            return $this->di->get(Controllers\RegistrationController::class);
        }

        if ($isMethodPost && $isPostRegistration !== false) {
            return $this->di->get(Controllers\PostRegistrationController::class);
        }

        $class = ucfirst($uri);
        $class = $class . 'Controller';

        $class = 'App\Controllers\\' . $class;

        if (class_exists($class) && isset($sessionId)) {
            if ($isMethodGet && $isCreate !== false) {
                return $this->di->get($class);
            } elseif ($isMethodPost && $isCreate !== false) {
                return $this->di->get($this->getClass($class));
            }

            if ($isMethodGet && $isEdit !== false) {
                return $this->di->get($class);
            } elseif ($isMethodPost && $isEdit !== false) {

                return $this->di->get($this->getClass($class));
            }

            return $this->di->get($class);
        } elseif (!isset($sessionId)) {
            if ($isMethodPost && $isLogin !== false) {
                return $this->di->get(Controllers\PostLoginController::class);
            }
            return $this->di->get(Controllers\LoginController::class);
        }

        return $this->di->get(Controllers\Error404Controller::class);
    }


    private function getClass(string $class): string
    {
        $class = explode('\\', $class);
        $postName = 'Post' . array_pop($class);
        $class[] = $postName;
        return implode('\\', $class);
    }
}
