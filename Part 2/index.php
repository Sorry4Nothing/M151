<?php

$urlParams = explode('/', $_SERVER['REQUEST_URI']);

array_shift($urlParams);

$controllerNamespace = 'Controllers';

$controllerName = $controllerNamespace . ucfirst(array_shift($urlParams)).'Controller';

$indexOfQuestionMark = strpos($urlParams[0], '?');

if ( $indexOfQuestionMark !== false) {
    $urlParams[0] = substr($urlParams[0], 0, $indexOfQuestionMark);
}

$actionName = strtolower(array_shift($urlParams));

$controller = new $controllerName;

$controller->$actionName();