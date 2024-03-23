<?php
    require_once './config/autoload.php';
    require_once './config/config.php';

    // L'action demandée par l'utilisateur.
    $action = Utils::request('action', 'home');

    $publicPageController = new PublicPageController();
    $messagingController = new MessagingController();
    $userController = new UserController();
    $bookController = new BookController();
    /**
     * @throws Exception
     */
    try {
        switch ($action) {
            // Pages publiques du site TomTroc.
            case 'home':
                $publicPageController->showHome();
                break;

            case 'library':
                $publicPageController->showLibrary();
                break;

            case 'bookDetails':
                $publicPageController->showBookDetails();
                break;

            case 'publicUserAccount':
                $publicPageController->showPublicUserAccount();
                break;

            case 'loginForm':
                $userController->showLoginForm();
                break;

            case 'registrationForm':
                $userController->showRegistrationForm();
                break;

            case 'login':
                $userController->loginUser();
                break;

            case 'registration':
                $userController->registrationUser();
                break;

            case 'search':
                $publicPageController->showLibrarySearch();
                break;

            case 'privacyPolicy':
                $publicPageController->showPrivacyPolicy();
                break;

            case 'termsOfUse':
                $publicPageController->showTermsOfUse();
                break;

            // Pages réservée aux utilisateurs inscrits ET connectés.
            case 'userAccount':
                $userController->showUser();
                break;

            case 'bookFormCreate':
                $bookController->addBook();
                break;

            case 'bookFormUpdate':
                $bookController->updateBook();
                break;

            case 'createBook':
                $bookController->createBook();
                break;

            case 'updatingBook':
                $bookController->UpdatingBook();
                break;

            case 'updateUser':
                $userController->updateUser();
                break;

            case 'updateUserImage':
                $userController->updateUserImage();
                break;

            case 'deleteBook':
                $bookController->deleteBook();
                break;

            case 'messaging':
                $messagingController->showMessaging();
                break;

            case 'addMessage':
                $messagingController->addMessage();
                break;

            case 'disconnect':
                $userController->disconnectUser();
                break;

            default:
                Utils::redirect('home');
        }

    } catch (Exception $e) {
        $errorView = new View('');
        $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
    }