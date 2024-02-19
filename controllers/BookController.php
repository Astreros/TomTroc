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

        $view = new View('Modifier un livre');
        $view->render('bookForm');
    }

    public function getAllAvailableBooks(): array
    {
        return [];
    }

    public function UpdatingBook(): void
    {

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

        if(!($available === 'available' || $available === 'not available')) {
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

        $title = Utils::request('title');
        $author = Utils::request('author');
        $description = Utils::request('description');
        $available = Utils::request('available');

        if (empty($title) || empty($author) || empty($description) || empty($available)) {
            $view = new View('Ajouter un livre');
            $view->render('BookForm', ['emptyError' => 'Tous les champs sont obligatoires.']);
            exit();
        }

        $title = strip_tags($title);
        $author = strip_tags($author);
        $description = strip_tags($description);
        $available = strip_tags($available);

        $errors = $this->valideAddBookData($title, $author, $description, $available);

        $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
        $author = htmlentities($author, ENT_QUOTES, 'UTF-8');
        $description = htmlentities($description, ENT_QUOTES, 'UTF-8');
        $available = htmlentities($available, ENT_QUOTES, 'UTF-8');

        $allowedMineType = ['image/jpeg', 'image/png'];

        $image = null;

        if (count($errors) === 0) {

            if (isset($_FILES['imageToUpload'])) {
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
                'available' => $available,
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
