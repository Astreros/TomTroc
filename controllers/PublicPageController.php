<?php

class PublicPageController
{
    /**
     * @throws Exception
     */
    public function showHome(): void
    {
        $view = new View('Accueil');
        $view->render('home');
    }

    /**
     * @throws Exception
     */
    public function showLibrary(): void
    {
        $view = new View('Bibliothèque');
        $view->render('library');
    }

    /**
     * @throws Exception
     */
    public function showBookDetails(): void
    {
        $view = new View('Détails livre');
        $view->render('bookDetails');
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