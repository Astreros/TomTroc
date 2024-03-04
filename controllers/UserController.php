<?php

use JetBrains\PhpStorm\NoReturn;

class UserController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function showUser(): void
    {
        Utils::checkIfUserIsConnected();

        $userId = $_SESSION['user']->getId();

        $bookManger = new BookManager();
        $userBooks = $bookManger->getAllBooksByUserId($userId);

        $_SESSION['userBooks'] = $userBooks;

        Utils::redirectWithoutParamsInUrl('userAccount');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function showLoginForm(): void
    {
        if (isset($_SESSION['user'])) {
            Utils::redirect('userAccount');
        }

        Utils::redirectWithoutParamsInUrl('loginForm');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function showRegistrationForm(): void
    {
        if (isset($_SESSION['user'])) {
            Utils::redirect('userAccount');
        }

        Utils::redirectWithoutParamsInUrl('registrationForm');
    }

    public function usernameOrEmailAlreadyExists($username, $email) :bool
    {
        return (new UserManager())->userExists($username, $email);
    }

    public function usernameOrEmailAlreadyExistsExceptCurrentUser($username, $email, $id) :bool
    {
        return (new UserManager())->exceptCurrentUserExists($username, $email, $id);
    }


    /**
     * @throws Exception
     */
    #[NoReturn] public function loginUser(): void
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        if (empty($email) || empty($password)) {
            Utils::redirectWithoutParamsInUrl('loginForm', ['emptyError' => "Tous les champs sont obligatoires."]);
        }

        $userManager = New UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user === null || !password_verify($password, $user->getPassword())) {
            Utils::redirectWithoutParamsInUrl('loginForm', ['loginError' => "Identifiants incorrects."]);
        }

        $_SESSION['user'] = $user;

        Utils::redirect('userAccount');
    }

    public function validateRegistrationData(string $username, string $email, string $password): array
    {
        $errors = [];

        if(!preg_match(USERNAME_REGEX_CHECK, $username)) {
            $errors['username'] = "Non d'utilisateur: 3 à 32 caractères alphanumériques uniquement.";
        }

        if(!preg_match(EMAIL_REGEX_CHECK, $email)) {
            $errors['email'] = "Format d'e-mail invalide.";
        }

        if(!preg_match(PASSWORD_REGEX_CHECK, $password)) {
            $errors['password'] = "Mot de passe: 12 à 72 caractères alphanumériques, dont une majuscule.";
        }

        return $errors;
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function registrationUser(): void
    {
        $username = strip_tags(Utils::request('username'));
        $email = strip_tags(Utils::request('email'));
        $password = strip_tags(Utils::request('password'));

        if (empty($email) || empty($password) || empty($username)) {

            Utils::redirectWithoutParamsInUrl('registrationForm', ['emptyError' => "Tous les champs sont obligatoires."]);
        }

        $usernameOrEmailAlreadyExists = $this->usernameOrEmailAlreadyExists($username, $email);
        $errors = $this->validateRegistrationData($username, $email, $password);

        $username = htmlspecialchars($username, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $password = htmlspecialchars($password, ENT_QUOTES);

        if ($usernameOrEmailAlreadyExists) {

            Utils::redirectWithoutParamsInUrl('registrationForm', ['alreadyExistsError' => "Nom d'utilisateur ou l'adresse mail est déjà utilisés."]);

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
            Utils::redirectWithoutParamsInUrl('registrationForm', ['errors' => $errors]);
        }
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function updateUserImage(): void
    {
        $id = $_SESSION['user']->getId();
        $oldImage = $_SESSION['user']->getImage();

        $allowedMineType = ['image/jpeg', 'image/png'];

        if ($_FILES['imageToUpload']['error'] !== UPLOAD_ERR_NO_FILE) {

            $image = $_FILES['imageToUpload'];

            $fileMimeType = finfo_open(FILEINFO_MIME_TYPE);
            $typeMine = finfo_file($fileMimeType, $image['tmp_name']);
            finfo_close($fileMimeType);

            if (in_array($typeMine, $allowedMineType, true)) {

                Utils::deleteImageFile($oldImage);
                $image = Utils::uploadImageFile($image, 'users', USERS_IMAGE_PATH);

            } else {
                Utils::redirectWithoutParamsInUrl('userAccount', ['formatError' => 'Uniquement les images JPEG et PNG sont acceptées.']);
            }
        } else {
            $image = $oldImage;
        }

        $userManager = new UserManager();
        $userManager->updateImageUserOnly($image, $id);

        $_SESSION['user']->setImage($image);

        Utils::redirectWithoutParamsInUrl('userAccount');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function updateUser(): void
    {
        Utils::checkIfUserIsConnected();

        $id = $_SESSION['user']->getId();

        $username = strip_tags(Utils::request('username'));
        $email = strip_tags(Utils::request('email'));
        $password = strip_tags(Utils::request('password'));
        $image = $_SESSION['user']->getImage();

        if (empty($email) || empty($password) || empty($username)) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['emptyError' => 'Tous les champs sont obligatoires.']);
        }

        $usernameOrEmailAlreadyExists = $this->usernameOrEmailAlreadyExistsExceptCurrentUser($username, $email, $id);
        $errors = $this->validateRegistrationData($username, $email, $password);

        $username = htmlspecialchars($username, ENT_QUOTES);
        $email = htmlspecialchars($email, ENT_QUOTES);
        $password = htmlspecialchars($password, ENT_QUOTES);

        if ($usernameOrEmailAlreadyExists) {
            Utils::redirectWithoutParamsInUrl('loginForm', ['alreadyExistsError' => 'Nom d\'utilisateur ou l\'adresse mail est déjà utilisés.']);
        }

        if (count($errors) === 0) {

            $password = password_hash($password, PASSWORD_DEFAULT);

            $user = new User([
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'image'=> $image
            ]);

            $userManager = new UserManager();
            $userManager->updateUser($user);

            Utils::redirectWithoutParamsInUrl('loginForm', ['success' => 'Vos informations ont bien été mise à jours.']);

        } else {

            Utils::redirectWithoutParamsInUrl('userAccount', ['errors' => $errors]);
        }
    }

    #[NoReturn] public function disconnectUser($route): void
    {
        unset($_SESSION['user']);
        Utils::redirect($route);
    }
}