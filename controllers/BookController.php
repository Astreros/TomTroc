<?php

use JetBrains\PhpStorm\NoReturn;

class BookController
{
    /**
     * @throws Exception
     */
    #[NoReturn] public function addBook(): void
    {
        Utils::checkIfUserIsConnected();

        Utils::redirect('bookFormCreate');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function updateBook(): void
    {
        Utils::checkIfUserIsConnected();

        $IdBookToBeUpdated = Utils::request('id');

        if (!$IdBookToBeUpdated) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['errorNoBookToUpdate' => 'Aucun livre à mettre a jour.']);
        }

        $bookManager = new BookManager();
        $bookToBeUpdated = $bookManager->getBookById($IdBookToBeUpdated);

        if ($bookToBeUpdated === null) {
            Utils::redirectWithoutParamsInUrl('userAccount', ['errorBookHasNotBeenFound' => 'Le livre à mettre à jour n\'a pas été trouvé. ']);
        }

        $_SESSION['bookToBeUpdated'] = $bookToBeUpdated;

        Utils::redirectWithoutParamsInUrl('bookFormUpdate');
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function UpdatingBook(): null
    {
        $bookId = Utils::request('id');
        $title = strip_tags(Utils::request('title'));
        $author = strip_tags(Utils::request('author'));
        $description = strip_tags(Utils::request('description'));
        $available = strip_tags(Utils::request('available'));
        $oldImage = Utils::request('oldImage');

        if (empty($title) || empty($author) || empty($description) || is_null($available)) {
            Utils::redirectWithoutParamsInUrl('bookFormUpdate', ['emptyError' => 'Tous les champs sont obligatoires']);
        }

        $errors = $this->valideAddBookData($title, $author, $description, $available);

        $title = htmlspecialchars($title, ENT_QUOTES);
        $author = htmlspecialchars($author, ENT_QUOTES);
        $description = Utils::protectedStringFormat($description);

        $allowedMineType = ['image/jpeg', 'image/png'];

        if (count($errors) === 0) {

            if ($_FILES['imageToUpload']['error'] !== UPLOAD_ERR_NO_FILE) {

                $image = $_FILES['imageToUpload'];

                $fileMimeType = finfo_open(FILEINFO_MIME_TYPE);
                $typeMine = finfo_file($fileMimeType, $image['tmp_name']);
                finfo_close($fileMimeType);

                if (in_array($typeMine, $allowedMineType, true)) {

                    Utils::deleteImageFile($oldImage);
                    $image = Utils::uploadImageFile($image, 'books', BOOKS_IMAGE_PATH);

                } else {
                    Utils::redirectWithoutParamsInUrl('bookFormUpdate', ['formatError' => 'Uniquement les images JPEG et PNG sont acceptées.']);
                }
            } else {
                $image = $oldImage;
            }

            $book = [
                'id' => $bookId,
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'image' => $image,
                'available' => $available,
            ];

            $bookManager = new BookManager();
            $bookManager->updateBook($book);

            Utils::redirect('userAccount');

        } else {
            Utils::redirectWithoutParamsInUrl('bookFormUpdate', ['errors' => $errors]);
        }
    }

    public function valideAddBookData(string $title, string $author, string $description, string $available): array
    {
        $errors = [];

        if(!preg_match(BOOK_TITLE_CHECK, $title)) {
            $errors['title'] = "Format du titre invalide. 3 à 144 caractères alphanumériques uniquement.";
        }

        if(!preg_match(BOOK_AUTHOR_CHECK, $author)) {
            $errors['author'] = "Format de l'auteur invalide. 3 à 32 caractères alphanumériques uniquement.";
        }

        if(!preg_match(BOOK_DESCRIPTION_CHECK, $description)) {
            $errors['description'] = "Format de la description invalide. 50 à 500 caractères (UTF-8).";
        }

        if(!($available === '1' || $available === '0')) {
            $errors['available'] = "Champs de disponibilité invalide.";
        }

        return $errors;
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function createBook(): void
    {
        $userId = $_SESSION['user']->getId();

        $title = strip_tags(Utils::request('title'));
        $author = strip_tags(Utils::request('author'));
        $description = strip_tags(Utils::request('description'));
        $available = strip_tags(Utils::request('available'));
        $image = null;

        if (empty($title) || empty($author) || empty($description) || empty($available)) {
            Utils::redirectWithoutParamsInUrl('bookFormCreate', ['emptyError' => 'Tous les champs sont obligatoires.']);
        }

        $errors = $this->valideAddBookData($title, $author, $description, $available);

        $title = htmlspecialchars($title, ENT_QUOTES);
        $author = htmlspecialchars($author, ENT_QUOTES);
        $description = Utils::protectedStringFormat($description);
        $available = htmlspecialchars($available, ENT_QUOTES);

        $booleanAvailable = $available === "true";


        $allowedMineType = ['image/jpeg', 'image/png'];

        if (count($errors) === 0) {

            if (isset($_FILES['imageToUpload']) && $_FILES['imageToUpload']['error'] !== UPLOAD_ERR_NO_FILE) {
                $image = $_FILES['imageToUpload'];

                $fileMimeType = finfo_open(FILEINFO_MIME_TYPE);
                $typeMine = finfo_file($fileMimeType, $image['tmp_name']);
                finfo_close($fileMimeType);

                if (in_array($typeMine, $allowedMineType, true)) {

                    $image = Utils::uploadImageFile($image, 'books', BOOKS_IMAGE_PATH);

                } else {
                    Utils::redirectWithoutParamsInUrl('bookFormCreate', ['formatError' => 'Uniquement les images JPEG et PNG sont acceptées.']);
                }
            }

            $book = new Book([
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'image' => $image,
                'available' => $booleanAvailable,
                'creation_date' => new DateTime(),
                'id' => $userId
            ]);

            $bookManager = new BookManager();
            $bookManager->addBook($book, $userId);

            Utils::redirect('bookDetails');

        } else {
            Utils::redirectWithoutParamsInUrl('bookFormCreate', ['errors' => $errors]);
        }
    }
}
