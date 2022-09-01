<?php

$stylesDir = APP_ROOT . '/App/Styles';
$dirList = scandir($stylesDir);
$dirList = array_slice($dirList, 2);

foreach ($dirList as $dir) {
    $path = "App/Styles/$dir/" . $dir . '.css';
    $fullPath = "<link rel=\"stylesheet\" href=\"$path\">";

    echo $fullPath;
}
