<?php

class PublicPageController
{
    /**
     * @throws Exception
     */
    public function showHome(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksAvailable();

        $lastBooks = array_slice($books, -4,4) ;

        $view = new View('Accueil');
        $view->render('home', ['lastBooks' => $lastBooks]);
    }

    /**
     * @throws Exception
     */
    public function showLibrary(): void
    {
        $bookManager = new BookManager();
        $allBooksAvailable = $bookManager->getAllBooksAvailable();

        $view = new View('Bibliothèque');
        $view->render('library', ['allBooksAvailable' => $allBooksAvailable]);
    }

    /**
     * @throws Exception
     */
    public function showBookDetails(): void
    {
        $bookId = Utils::request('id');

        if (!$bookId) {
            Utils::redirect('library');
        }

        $bookManger = new BookManager();
        $book = $bookManger->getBookById($bookId);

        $userManager = new UserManager();
        $user = $userManager->getUserByBookId($bookId);

        $view = new View('Détails livre');
        $view->render('bookDetails', ['book' => $book, 'bookUser' => $user]);
    }

    /**
     * @throws Exception
     */
    public function showPublicUserAccount(): void
    {
        $view = new View('Compte public utilisateur');
        $view->render('publicUserAccount');
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