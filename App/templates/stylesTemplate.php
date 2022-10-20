<?php

$stylesDir = APP_ROOT . '/pub/Styles';
$dirList = scandir($stylesDir);
$dirList = array_slice($dirList, 2);

foreach ($dirList as $dir) {
    $path = "Styles/$dir/" . $dir . '.css';
    $fullPath = "<link rel=\"stylesheet\" href=\"$path\">";

    echo $fullPath;
}
