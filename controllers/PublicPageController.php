<?php

class PublicPageController
{
    /**
     * @throws Exception
     */
    public function showHome(): void
    {
        $view = new View('Accueil');
        $view->render('home', ['variableTest' => 'Hello World ! Page d\'Accueil']);
    }

    /**
     * @throws Exception
     */
    public function showLibrary(): void
    {
        $view = new View('Bibliothèque');
        $view->render('library', ['variableTest' => 'Hello World ! Page de nos livres à l\'échange']);
    }

    /**
     * @throws Exception
     */
    public function showBookDetails(): void
    {
        $view = new View('Détails livre');
        $view->render('bookDetails', ['variableTest' => 'Hello World ! Page des détails d\'un livre']);
    }

    /**
     * @throws Exception
     */
    public function showPublicUserAccount(): void
    {
        $view = new View('Compte public utilisateur');
        $view->render('publicUserAccount', ['variableTest' => 'Hello World ! Page public d\'un utilisateur']);
    }

    /**
     * @throws Exception
     */
    public function showPrivacyPolicy(): void
    {
        $view = new View('Politique de confidentialité');
        $view->render('privacyPolicy', ['variableTest' => 'Hello World ! Page public de la politique de confidentialité']);
    }

    /**
     * @throws Exception
     */
    public function showTermsOfUse(): void
    {
        $view = new View('Mentions légales');
        $view->render('termsOfUse', ['variableTest' => 'Hello World ! Page public des mentions légales']);
    }
}