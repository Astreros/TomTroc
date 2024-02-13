<?php

    require_once './config/config.php';
    require_once './config/autoload.php';

    // L'action demandée par l'utilisateur.
    $action = Utils::request('action', 'home');

    /**
     * @throws Exception
     */
    try {
        switch ($action) {
            // Pages publiques du site TomTroc.
            case 'home':
                $publicPageController = new PublicPageController();
                $publicPageController->showHome();
                break;

            case 'library':
                $publicPageController = new PublicPageController();
                $publicPageController->showLibrary();
                break;

            case 'bookDetails':
                $publicPageController = new PublicPageController();
                $publicPageController->showBookDetails();
                break;

            case 'publicUserAccount':
                $publicPageController = new PublicPageController();
                $publicPageController->showPublicUserAccount();
                break;

            case 'login':
                $userController = new UserController();
                $userController->showLoginForm();
                break;

            case 'registration':
                $userController = new UserController();
                $userController->showRegistrationForm();
                break;

            case 'privacyPolicy':
                $publicPageController = new PublicPageController();
                $publicPageController->showPrivacyPolicy();
                break;

            case 'termsOfUse':
                $publicPageController = new PublicPageController();
                $publicPageController->showTermsOfUse();
                break;

            // Pages réservée aux utilisateurs inscrits ET connectés.
            case 'userAccount':
                $userController = new UserController();
                $userController->showUser();
                break;

            case 'createBook':
                $bookController = new BookController();
                $bookController->addBook();
                break;

            case 'updateBook':
                $bookController = new BookController();
                $bookController->updateBook();
                break;

            case 'messaging':
                $messagingController = new MessagingController();
                $messagingController->showMessaging();
                break;

            default:
//                $error404 = new View('Erreur 404');
//                $error404->render('error404');
                throw new Exception("La page demandée n'existe pas.");
        }
    } catch (Exception $e) {
        $errorView = new View('');
        $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
    }