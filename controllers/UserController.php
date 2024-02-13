<?php

class UserController
{
    /**
     * @throws Exception
     */
    public function showUser(): void
    {
        $view = new View('Profil utilisateur');
        $view->render('userAccount', ['variableTest' => 'Hello World ! Page profil utilisateur']);
    }

    /**
     * @throws Exception
     */
    public function showLoginForm(): void
    {
        $view = new View('Formulaire de connexion');
        $view->render('loginForm', ['variableTest' => 'Hello World ! Page avec formulaire de connexion']);
    }

    /**
     * @throws Exception
     */
    public function showRegistrationForm(): void
    {
        $view = new View('Formulaire d\'inscription');
        $view->render('registrationForm', ['variableTest' => 'Hello World ! Page avec formulaire d\'inscription']);
    }
}