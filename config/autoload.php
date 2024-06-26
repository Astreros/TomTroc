<?php
// Système autoload : PHP va appeler cette fonction à chaque fois qu'il a besoin d'une classe.
spl_autoload_register(static function ($className) {
    if (file_exists('services/' . $className . '.php')) {
        require_once 'services/' . $className . '.php';
    }

    if (file_exists('models/' . $className . '.php')) {
        require_once 'models/' . $className . '.php';
    }

    if (file_exists('models/managers/' . $className . '.php')) {
        require_once 'models/managers/' . $className . '.php';
    }

    if (file_exists('models/validators/' . $className . '.php')) {
        require_once 'models/validators/' . $className . '.php';
    }

    if (file_exists('controllers/' . $className . '.php')) {
        require_once 'controllers/' . $className . '.php';
    }

    if (file_exists('views/' . $className . '.php')) {
        require_once 'views/' . $className . '.php';
    }
});