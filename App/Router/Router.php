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

        if ($uri == '') {
            return $this->di->get(Controllers\HomePageController::class);
        }

        if ($uri == 'registration') {
            return $this->di->get(Controllers\RegistrationController::class);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($uri, 'postRegistration') !== false) {
            return $this->di->get(Controllers\PostRegistrationController::class);
        }

        $class = ucfirst($uri);
        $class = $class . 'Controller';

        $class = 'App\Controllers\\' . $class;

        if (class_exists($class) && isset($sessionId)) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && stripos($uri, 'create') !== false) {
                return $this->di->get($class);
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($uri, 'create') !== false) {
                $class = explode('\\', $class);
                $postName = 'Post' . array_pop($class);
                $class[] = $postName;
                $class = implode('\\', $class);

                return $this->di->get($class);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'GET' && stripos($uri, 'edit') !== false) {
                return $this->di->get($class);
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($uri, 'edit') !== false) {
                $class = explode('\\', $class);
                $postName = 'Post' . array_pop($class);
                $class[] = $postName;
                $class = implode('\\', $class);

                return $this->di->get($class);
            }

            return $this->di->get($class);
        } elseif (!isset($sessionId)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($uri, 'postLogin') !== false) {
                return $this->di->get(Controllers\PostLoginController::class);
            }
            return $this->di->get(Controllers\LoginController::class);
        }

        return $this->di->get(Controllers\Error404Controller::class);
    }
}
