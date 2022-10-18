#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));

$fileCacheModel = new \App\Models\FileCacheModel();
$redisCacheModel = new \App\Models\RedisCacheModel();

$redisCacheModel->clearCache('environment');
$fileCacheModel->clearCache('environment');

Echo 'ready!' . PHP_EOL;