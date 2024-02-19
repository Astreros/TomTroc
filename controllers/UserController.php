<?php

use JetBrains\PhpStorm\NoReturn;

class UserController
{
    /**
     * @throws Exception
     */
    public function showUser(): void
    {
        Utils::checkIfUserIsConnected();

        $user = $_SESSION['user'];

        $view = new View('Profil utilisateur');
        $view->render('userAccount', ['user' => $user]);
    }

    /**
     * @throws Exception
     */
    public function showLoginForm(): void
    {
        if (isset($_SESSION['user'])) {
            Utils::redirect('userAccount');
        }

        $view = new View('Formulaire de connexion');
        $view->render('loginForm');
    }

    /**
     * @throws Exception
     */
    public function showRegistrationForm(): void
    {
        if (isset($_SESSION['user'])) {
            Utils::redirect('userAccount');
        }

        $view = new View('Formulaire d\'inscription');
        $view->render('registrationForm');
    }

    public function usernameOrEmailAlreadyExists($username, $email) :bool
    {
        return (new UserManager())->userExists($username, $email);
    }


    /**
     * @throws Exception
     */
    #[NoReturn] public function loginUser(): void
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        if (empty($email) || empty($password)) {
            $view = new View('Formulaire de connexion');
            $view->render('loginForm', ['emptyError' => 'Tous les champs sont obligatoires.']);
            exit();
        }

        $userManager = New UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user === null || !password_verify($password, $user->getPassword())) {
            $view = new View('Formulaire de connexion');
            $view->render('loginForm', ['loginError' => 'Identifiants incorrects.']);
            exit();
        }

        $_SESSION['user'] = $user;

        Utils::redirect('userAccount');
    }

    public function validateRegistrationData(string $username, string $email, string $password): array
    {
        $username = strip_tags($username);
        $email = strip_tags($email);
        $password = strip_tags($password);

        $errors = [];
        $validateData = [];

        if(!preg_match(USERNAME_REGEX_CHECK, $username)) {
            $errors['username'] = "Format du nom d'utilisateur invalide. 3 à 32 caractères alphanumériques uniquement.";
        }

        if(!preg_match(EMAIL_REGEX_CHECK, $email)) {
            $errors['email'] = "Format d'e-mail invalide.";
        }

        if(!preg_match(PASSWORD_REGEX_CHECK, $password)) {
            $errors['password'] = "Format de mot de passe invalide. 12 à 72 caractères alphanumériques, dont une majuscule. NE doit PAS contenir les caractères spéciaux suivant '<' et '>'";
        }

        return $errors;
    }

    /**
     * @throws Exception
     */
    public function registrationUser(): void
    {
        $username = Utils::request('username');
        $email = Utils::request('email');
        $password = Utils::request('password');

        if (empty($email) || empty($password) || empty($username)) {
            $view = new View('Formulaire d\'inscription');
            $view->render('registrationForm', ['emptyError' => 'Tous les champs sont obligatoires.']);
            exit();
        }

        $usernameOrEmailAlreadyExists = $this->usernameOrEmailAlreadyExists($username, $email);
        $errors = $this->validateRegistrationData($username, $email, $password);

        $view = new View('Formulaire d\'inscription');

        if ($usernameOrEmailAlreadyExists) {

            $view->render('registrationForm', ['alreadyExistsError' => "Nom d'utilisateur ou l'adresse mail est déjà utilisés."]);

        } elseif (count($errors) === 0) {

            $password = password_hash($password, PASSWORD_DEFAULT);

            $user = new User([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'creationDate' => new DateTime()
            ]);

            $userManager = new UserManager();
            $userManager->addUser($user);

            Utils::redirect('loginForm');

        } else {
            $view->render('registrationForm', ['errors' => $errors]);
        }
    }

    #[NoReturn] public function disconnectUser(): void
    {
        unset($_SESSION['user']);

        Utils::redirect("home");
    }
}