<?php
    // Démarrage de la Session.
    session_start();

    // Constantes des chemins d'accès.
    const TEMPLATE_VIEW_PATH = './views/templates/';
    const MAIN_VIEW_PATH = TEMPLATE_VIEW_PATH . 'main.php';
    const USERS_IMAGE_DIRECTORY = './images/users/';
    const BOOKS_IMAGE_DIRECTORY = './images/books/';
    const USER_IMAGE_DEFAULT_PATH = './images/users/default_user_image.jpg';

    // Constantes de configuration de la base de données.
    const DB_HOST = 'localhost';
    const DB_NAME = '';
    const DB_USER = '';
    const DB_PASS = '';