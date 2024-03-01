<?php

use JetBrains\PhpStorm\NoReturn;

class PublicPageController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksAvailable();

        $lastBooks = array_slice($books, -4,4) ;

        Utils::redirectWithoutParamsInUrl('home', ['lastBooks' => $lastBooks]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function showLibrary(): void
    {
        $bookManager = new BookManager();
        $allBooksAvailable = $bookManager->getAllBooksAvailable();

        Utils::redirectWithoutParamsInUrl('library', ['allBooksAvailable' => $allBooksAvailable]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function showLibrarySearch(): void
    {
        $userRequest = strip_tags(Utils::request('search'));

        if (empty($userRequest)) {
            Utils::redirect('library');
        }

        $userRequest = htmlspecialchars($userRequest, ENT_QUOTES);

        $bookManager = new BookManager();
        $searchResults = $bookManager->getSearchBookResultByTitle($userRequest);

        Utils::redirectWithoutParamsInUrl('library', ['searchResults' => $searchResults]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function showBookDetails(): void
    {
        $bookId = Utils::request('id');

        if (!$bookId) {
            Utils::redirect('library');
        }

        $bookManger = new BookManager();
        $book = $bookManger->getBookById($bookId);

        $userManager = new UserManager();
        $user = $userManager->getUserByBookId($bookId);

        Utils::redirectWithoutParamsInUrl('bookDetails', ['book' => $book, 'bookUser' => $user]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function showPublicUserAccount(): void
    {
        $idAccountRequest = (int)Utils::request('id');

        if (!$idAccountRequest) {
            Utils::redirect('home');
        }

        $userManager = new UserManager();
        $user = $userManager->getUserById($idAccountRequest);

        if (!$user) {
            Utils::redirect('home');
        }

        if(isset($_SESSION['user'])) {
            $idCurrentUser = $_SESSION['user']->getId();
            if ($idCurrentUser === $idAccountRequest) {
                Utils::redirect('userAccount');
            }
        }

        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksByUserId($idAccountRequest);

        Utils::redirectWithoutParamsInUrl('publicUserAccount', ['publicUserAccount' => $user, 'publicUserBooks' => $books]);
    }

    /**
     * @throws Exception
     */
    public function showPrivacyPolicy(): void
    {
        $view = new View('Politique de confidentialité');
        $view->render('privacyPolicy');
    }

    /**
     * @throws Exception
     */
    public function showTermsOfUse(): void
    {
        $view = new View('Mentions légales');
        $view->render('termsOfUse');
    }
}