<?php

use JetBrains\PhpStorm\NoReturn;

class BookController
{
    /**
     * @throws Exception
     */
    public function addBook(): void
    {
        Utils::checkIfUserIsConnected();

        $view = new View('Ajouter un livre');
        $view->render('bookForm');
    }

    /**
     * @throws Exception
     */
    public function updateBook(): void
    {
        Utils::checkIfUserIsConnected();

        $IdBookToBeUpdated = Utils::request('id', -1);

        if ($IdBookToBeUpdated === -1) {
            Utils::redirect('userBook', ['errorNoBookToUpdate' => 'Aucun livre à mettre a jour.']);
        }

        $bookManager = new BookManager();
        $bookToBeUpdated = $bookManager->getBookById($IdBookToBeUpdated);

        if ($bookToBeUpdated === null) {
            Utils::redirect('userBook', ['errorBookHasNotBeenFound' => 'Le livre à mettre à jour n\'a pas été trouvé. ']);
        }

        $view = new View('Modifier un livre');
        $view->render('bookForm', ['bookToBeUpdated' => $bookToBeUpdated]);
    }

    /**
     * @throws Exception
     */
    public function showUserBooks(): void
    {
        Utils::checkIfUserIsConnected();

        $view = new View('Livres de l\'utilisateur');
        $view->render('userbook');
    }

    public function getAllAvailableBooks(): array
    {
        return [];
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

        if (empty($title) || empty($author) || empty($description) || empty($available)) {
            $view = new View('Ajouter un livre');
            $view->render('BookForm', ['emptyError' => 'Tous les champs sont obligatoires']);
            exit();
        }

        $errors = $this->valideAddBookData($title, $author, $description, $available);

        $title = htmlspecialchars($title, ENT_QUOTES);
        $author = htmlspecialchars($author, ENT_QUOTES);
        $description = htmlspecialchars($description, ENT_QUOTES);
        $available = htmlspecialchars($available, ENT_QUOTES);

        $booleanAvailable = $available === "true";

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
                    $view = new View('Ajouter un livre');
                    $view->render('BookForm', ['formatError' => 'Uniquement les images JPEG et PNG sont acceptées.']);
                    exit();
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
                'available' => $booleanAvailable,
            ];

            $bookManager = new BookManager();
            $bookManager->updateBook($book);

            Utils::redirect('bookDetails');

        } else {
            $view = new View('Ajouter un livre');
            $view->render('BookForm', ['errors' => $errors]);
            exit();
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
            $errors['description'] = "Format de la description invalide. 50 à 2000 caractères (UTF-8).";
        }

        if(!($available === 'true' || $available === 'false')) {
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
            $view = new View('Ajouter un livre');
            $view->render('BookForm', ['emptyError' => 'Tous les champs sont obligatoires.']);
            exit();
        }

        $errors = $this->valideAddBookData($title, $author, $description, $available);

        $title = htmlspecialchars($title, ENT_QUOTES);
        $author = htmlspecialchars($author, ENT_QUOTES);
        $description = htmlspecialchars($description, ENT_QUOTES);
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
                    $view = new View('Ajouter un livre');
                    $view->render('BookForm', ['formatError' => 'Uniquement les images JPEG et PNG sont acceptées.']);
                    exit();
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
            $view = new View('Ajouter un livre');
            $view->render('BookForm', ['errors' => $errors]);
            exit();
        }
    }
}
