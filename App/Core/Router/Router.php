<?php

namespace App\Core\Router;

use App\Core\Controllers;
use App\Core\Models\SessionModel;
use App\ModuleSettingsAggregator;

class Router extends AbstractRouter
{
    public function parseControllers(string $path): ?Controllers\AbstractController
    {
        $session = $this->di->get(SessionModel::class);
        $session->runSession();

        $sessionId = $session->getUserId();

        $uri = $this->handleUri($path);
        $uri = ucfirst($uri);

        $mapping = $this->di->get(ModuleSettingsAggregator::class);
        $mapping = $mapping->getWebRoutes();

        $controllerClass = $mapping[$uri] ?? null;

        $isMethodPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $isMethodGet  = $_SERVER['REQUEST_METHOD'] === 'GET';
        $isPostRegistration = stripos($uri, 'postRegistration');
        $isCreate = stripos($uri, 'create');
        $isEdit   = stripos($uri, 'edit');
        $isLogin  = stripos($uri, 'postLogin');

        if ($uri == '') {
            return $this->di->get($controllerClass);
        }

        if ($uri == 'Registration') {
            return $this->di->get($controllerClass);
        }

        if ($isMethodPost && $isPostRegistration !== false) {
            return $this->di->get($controllerClass);
        }

        if (isset($sessionId) && $controllerClass != null) {
            if ($isMethodGet && $isCreate !== false) {
                return $this->di->get($controllerClass);
            } elseif ($isMethodPost && $isCreate !== false) {
                $controllerClass = $mapping['Post' . $uri] ?? null;
                return $this->di->get($controllerClass);
            }

            if ($isMethodGet && $isEdit !== false) {
                return $this->di->get($controllerClass);
            } elseif ($isMethodPost && $isEdit !== false) {
                $controllerClass = $mapping['Post' . $uri] ?? null;
                return $this->di->get($controllerClass);
            }

            return $this->di->get($controllerClass);
        } elseif (!isset($sessionId)) {
            if ($isMethodPost && $isLogin !== false) {
                return $this->di->get($controllerClass);
            }
            return $this->di->get($controllerClass);
        }

        return $this->di->get($mapping['error404']);
    }
}
