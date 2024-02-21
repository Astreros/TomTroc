<?php

    require_once './config/autoload.php';
    require_once './config/config.php';

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

            case 'loginForm':
                $userController = new UserController();
                $userController->showLoginForm();
                break;

            case 'registrationForm':
                $userController = new UserController();
                $userController->showRegistrationForm();
                break;

            case 'login':
                $userController = new UserController();
                $userController->loginUser();
                break;

            case 'registration':
                $userController = new UserController();
                $userController->registrationUser();
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

            case 'createBookForm':
                $bookController = new BookController();
                $bookController->addBook();
                break;

            case 'updateBookForm':
                $bookController = new BookController();
                $bookController->updateBook();
                break;

            case 'createBook':
                $bookController = new BookController();
                $bookController->createBook();
                break;

            case 'updatingBook':
                $bookController = new BookController();
                $bookController->UpdatingBook();
                break;

            case 'userBook':
                $bookController = new BookController();
                $bookController->showUserBooks();
                break;

            case 'messaging':
                $messagingController = new MessagingController();
                $messagingController->showMessaging();
                break;

            case 'disconnect':
                $userController = new UserController();
                $userController->disconnectUser();
                break;

            default:
                Utils::redirect('home');
        }

    } catch (Exception $e) {
        $errorView = new View('');
        $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
    }