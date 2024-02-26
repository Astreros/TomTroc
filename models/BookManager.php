<?php

class BookManager extends AbstractEntityManager
{
    public function addBook(Book $book, int $idUser): void
    {
        $statement = "INSERT INTO books (title, author, description, image, available, creation_date, Id_users) VALUES (:title, :author, :description, :image, :available, :creation_date, :Id_users)";

        $this->database->query($statement,
        [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'available' => $book->getAvailable(),
            'creation_date' => $book->getCreationDateString(),
            'Id_users' => $idUser
        ]);
    }

    public function updateBook(array $book): void
    {
        $statement = "UPDATE books SET title = :title, author = :author, description = :description, image = :image, available = :available WHERE Id_books = :Id_books";

        $this->database->query($statement,
        [
            'Id_books' => $book['id'],
            'title' => $book['title'],
            'author' => $book['author'],
            'description' => $book['description'],
            'image' => $book['image'],
            'available' => $book['available']
        ]);
    }

    public function getBookById(int $id): Book|null
    {
        $statement = "SELECT *, Id_books AS id FROM books WHERE Id_books = :id";

        $result = $this->database->query($statement, ['id' => $id]);
        $book = $result->fetch();

        if ($book) {
            return new Book($book);
        }

        return null;
    }

    public function getSearchBookResultByTitle(string $userQuery): array|null
    {
        $books = [];
        $userQuery = "%" . $userQuery . "%";

        $statement = "SELECT  *, Id_books AS id FROM books WHERE title LIKE :query AND  available = TRUE";

        $result = $this->database->query($statement, ['query' => $userQuery]);

        while ($bok = $result->fetch()) {
            $books[] = new Book($books);
        }

        return !empty($books) ? $books : null;
    }

    public function getAllBooksAvailable(?int $id = null): array|null
    {
        $books = [];

        if($id) {
            $statement = "SELECT books.*, books.Id_books AS id, users.username AS seller FROM books LEFT JOIN users ON books.Id_users = users.Id_users WHERE books.Id_books = :id AND available = TRUE";

            $result = $this->database->query($statement, ['id' => $id]);

            while ($book = $result->fetch()) {
                $books[] = new Book($book);
            }

            return !empty($books) ? $books : null;
        }

        $statement = "SELECT books.*, books.Id_books AS id, users.username AS seller FROM books LEFT JOIN users ON books.Id_users = users.Id_users WHERE available = TRUE";

        $result = $this->database->query($statement);

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }

        return !empty($books) ? $books : null;
    }

    public function deleteBookById(int $id): void
    {
        $statement = "DELETE FROM books WHERE Id_books = :id";

        $this->database->query($statement, ['id' => $id]);
    }
}