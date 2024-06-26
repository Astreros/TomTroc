<?php

/**
 * Classe qui gère les utilisateurs.
 *
 * Hérite de AbstractEntityManager pour la connexion à la base de données.
 *
 * @author leprini
 */
class UserManager extends AbstractEntityManager
{
    public function addUser(User $user): void
    {
        $statement = "INSERT INTO users (username, email, password, image, creation_date) VALUES (:username, :email, :password, :image, :creation_date)";

        $this->database->query($statement,
        [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'image' => $user->getImage(),
            'creation_date' => $user->getCreationDateString()
        ]);
    }

    public function updateUser(User $user): void
    {
        $statement = "UPDATE users SET username = :username, email = :email, password = :password, image = :image WHERE Id_users = :id";

        $this->database->query($statement,
        [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'image' => $user->getImage(),
        ]);
    }

    public function updateImageUserOnly(string $image, int $id): void
    {
        $statement = "UPDATE users SET image = :image WHERE Id_users = :id";

        $this->database->query($statement, ['id' => $id, 'image' => $image]);
    }

    public function getUserById(int $id): User|null
    {
        $statement = "SELECT *, Id_users AS id FROM users WHERE Id_users = :id";

        $result = $this->database->query($statement, ['id' => $id]);
        $user = $result->fetch();

        if($user) {
            return new User($user);
        }

        return null;
    }

    public function getUserByBookId(int $idBook): User|null
    {
        $statement = "SELECT users.*, users.Id_users AS id FROM users INNER JOIN books ON users.Id_users = books.Id_users WHERE books.Id_books = :idBook";

        $result = $this->database->query($statement, ['idBook' => $idBook]);
        $user = $result->fetch();

        if ($user) {
            return new User($user);
        }

        return null;
    }

    public function getUserByEmail(string $email): User|null
    {
        $statement = "SELECT *, Id_users AS id FROM users WHERE email = :email";

        $result = $this->database->query($statement, ['email' => $email]);
        $user = $result->fetch();

        if($user) {
            return New User($user);
        }

        return null;
    }

    public function userExists($username, $email): bool
    {
        $statement = "SELECT * FROM users WHERE username = :username OR email = :email";

        $result = $this->database->query($statement, ['username' => $username, 'email' => $email]);

        return $result->rowCount() > 0;
    }

    public function exceptCurrentUserExists($username, $email, $id): bool
    {
        $statement = "SELECT * FROM users WHERE (username = :username OR email = :email) AND Id_users != :id";

        $result = $this->database->query($statement, ['username' => $username, 'email' => $email, 'id' => $id]);

        return $result->rowCount() > 0;
    }


    public function deleteUserById(int $id): void
    {
        $statement = "DELETE FROM users WHERE Id_users = :id";

        $this->database->query($statement, ['id' => $id]);
    }
}