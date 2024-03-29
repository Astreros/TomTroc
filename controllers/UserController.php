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

    /**
     * @throws Exception
     */
    #[NoReturn] public function loginUser(): void
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        if (empty($email) || empty($password)) {
            Utils::redirectWithoutParamsInUrl('loginForm', ['errors' => "Tous les champs sont obligatoires."]);
        }

        $userManager = New UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user === null || !password_verify($password, $user->getPassword())) {
            Utils::redirectWithoutParamsInUrl('loginForm', ['errors' => "Identifiants incorrects."]);
        }

        $_SESSION['user'] = $user;

        Utils::redirect('userAccount');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function registrationUser(): void
    {
        $rawData = [
            'username' => strip_tags(Utils::request('username')),
            'email' => strip_tags(Utils::request('email')),
            'password' => strip_tags(Utils::request('password')),
        ];

        $userValidator = new UserValidator();

        $userErrors = $userValidator->validate($rawData);

        if (!empty($userErrors)) {
            Utils::redirectWithoutParamsInUrl('registrationForm', [
                'errors' => $userErrors,
            ]);
        }

        $usernameOrEmailAlreadyExists = $this->usernameOrEmailAlreadyExists($rawData['username'], $rawData['email']);

        if ($usernameOrEmailAlreadyExists) {
            Utils::redirectWithoutParamsInUrl('registrationForm', [
                'errors' => "Le nom d'utilisateur ou l'adresse mail sont déjà utilisés."
            ]);
        }

        $password = password_hash($rawData['password'], PASSWORD_DEFAULT);

        $user = new User([
            'username' => htmlspecialchars($rawData['username']),
            'email' => htmlspecialchars($rawData['email']),
            'password' => $password,
            'creationDate' => new DateTime(),
        ]);

        $userManager = new UserManager();
        $userManager->addUser($user);

        Utils::redirectWithoutParamsInUrl('loginForm', [
            'success' => 'Votre compte à été créé avec succès.'
        ]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function updateUserImage(): void
    {
        Utils::checkIfUserIsConnected();


        $id = $_SESSION['user']->getId();
        $image = $_FILES['imageToUpload'];
        $oldImage = $_SESSION['user']->getImage();

        $imageValidator = new ImageValidator();
        $imageErrors = $imageValidator->validate([
            'image' => $image
        ]);

        if (!empty($imageErrors)) {
            Utils::redirectWithoutParamsInUrl('userAccount', [
                'errors' => $imageErrors
            ]);
        }

        $imagePath = Utils::uploadImageFile($image, 'users', USERS_IMAGE_DIRECTORY);

        if (!$imagePath['success']) {
            Utils::redirectWithoutParamsInUrl('userAccount', [
                'errors' => $imagePath['message']
            ]);
        } else {
            $imagePath = $imagePath['message'];
        }

        if ((strpos($oldImage, USERS_IMAGE_DIRECTORY )) !== 0) {
            Utils::redirectWithoutParamsInUrl('userAccount', [
                'errors' => "Le chemin d'accès de l'ancienne image n'est pas valide ou n'est pas autorisé"
            ]);
        }

        Utils::deleteImageFile($oldImage);

        $userManager = new UserManager();
        $userManager->updateImageUserOnly($imagePath, $id);

        $_SESSION['user']->setImage($imagePath);

        Utils::redirectWithoutParamsInUrl('userAccount', [
            'success' => 'Votre image à bien été mise à jour.'
        ]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function updateUser(): void
    {
        Utils::checkIfUserIsConnected();

        $id = $_SESSION['user']->getId();

        $rawData = [
            'username' => strip_tags(Utils::request('username')),
            'email' => strip_tags(Utils::request('email')),
            'password' => strip_tags(Utils::request('password')),
        ];

        $userValidator = new UserValidator();

        $userErrors = $userValidator->validate($rawData);

        if (!empty($userErrors)) {
            Utils::redirectWithoutParamsInUrl('userAccount', [
                'errors' => $userErrors
            ]);
        }

        $alreadyExists = $this->usernameOrEmailAlreadyExistsExceptCurrentUser(
            $rawData['username'],
            $rawData['email'],
            $id
        );

        if ($alreadyExists) {
            Utils::redirectWithoutParamsInUrl('userAccount', [
                'errors' => "Le nom d'utilisateur ou l'adresse mail sont déjà utilisés."
            ]);
        }

        $password = password_hash($rawData['password'], PASSWORD_DEFAULT);

        $user = new User([
            'id' => $id,
            'username' => htmlspecialchars($rawData['username']),
            'email' => htmlspecialchars($rawData['email']),
            'password' => $password
        ]);

        $userManager = new UserManager();
        $userManager->updateUser($user);

        unset($_SESSION['user']);

        Utils::redirectWithoutParamsInUrl('loginForm', [
            'success' => 'Vos informations ont bien été mise à jours.'
        ]);
    }

    public function usernameOrEmailAlreadyExists($username, $email) :bool
    {
        return (new UserManager())->userExists($username, $email);
    }

    public function usernameOrEmailAlreadyExistsExceptCurrentUser($username, $email, $id) :bool
    {
        return (new UserManager())->exceptCurrentUserExists($username, $email, $id);
    }

    public function disconnectUser(): void
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            Utils::redirect('home');
        }
    }
}