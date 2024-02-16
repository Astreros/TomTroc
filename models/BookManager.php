<?php

class BookManager extends AbstractEntityManager
{
    public function addBook(Book $book, int $id): void
    {
        $statement = "INSERT INTO books (title, author, description, image, available, creation_date, Id_users) VALUES (:title, :author, :description, :image, :available, :creation_date, :Id_users)";

        $this->database->query($statement,
        [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'available' => $book->getAvailable(),
            'creation_date' => $book->getCreationDate(),
            'Id_users' => $id
        ]);
    }

    public function updateBook(Book $book): void
    {
        $statement = "UPDATE books SET title = :title, author = :author, description = :description, image = :image, available = :available WHERE Id_books = :Id_books";

        $this->database->query($statement,
        [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'available' => $book->getAvailable(),
            'Id_books' => $book->getId()
        ]);
    }

    public function getBookById(): Book
    {

    }

    public function getBookByTitle(): Book
    {

    }

    public function getAllBooksAvailable(?int $id): array|null
    {
        $books = [];

        if($id) {
            $statement = "SELECT * FROM books WHERE Id_users = :id AND available = TRUE";

            $result = $this->database->query($statement, ['id' => $id]);

            while ($book = $result->fetch()) {
                $books[] = new Book($book);
            }

            return !empty($books) ? $books : null;
        }

        $statement = "SELECT * FROM books WHERE available = TRUE";

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