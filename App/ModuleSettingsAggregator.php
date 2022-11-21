<?php

declare(strict_types=1);

namespace App;

class ModuleSettingsAggregator
{
    public const SETTINGS_WEB_ROUTES   = 'web_routes';
    public const SETTINGS_API_ROUTES   = 'api_routes';
    public const SETTINGS_CON_ROUTES   = 'console_routes';
    public const SETTINGS_DI_CONTAINER = 'di_containers';

    protected static $allowedSections = [
        self::SETTINGS_WEB_ROUTES,
        self::SETTINGS_API_ROUTES,
        self::SETTINGS_CON_ROUTES,
        self::SETTINGS_DI_CONTAINER,
    ];
    protected static $mergedSettings;

    public function getWebRoutes(): array
    {
        return self::getMergedSettings()[self::SETTINGS_WEB_ROUTES] ?? [];
    }

    public function getConRoutes(): array
    {
        return self::getMergedSettings()[self::SETTINGS_CON_ROUTES] ?? [];
    }

    public function getApiRoutes(): array
    {
        return self::getMergedSettings()[self::SETTINGS_API_ROUTES] ?? [];
    }

    public function getDiContainers()
    {
        return self::getMergedSettings()[self::SETTINGS_DI_CONTAINER] ?? null;
    }

    protected function getMergedSettings(): array
    {
        if (self::$mergedSettings !== null) {
            return self::$mergedSettings;
        }

        self::$mergedSettings = [];

        $modules = include_once APP_ROOT . '/App/modules.php';

        foreach ($modules as $module) {
            $settings = include_once APP_ROOT . '/App/' . $module . '/settings.php';

            foreach (self::$allowedSections as $section) {
                if (!isset(self::$mergedSettings[$section])) {
                    self::$mergedSettings[$section] = [];
                }

                self::$mergedSettings[$section] += $settings[$section];
            }
        }

        return self::$mergedSettings;
    }
}
