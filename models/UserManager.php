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
            'creation_date' => $user->getCreationDate()
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

    public function getUserById(int $id): ?User
    {
        $statement = "SELECT * FROM users WHERE Id_users = :id";

        $result = $this->database->query($statement,['id' => $id]);
        $user = $result->fetch();

        if($user) {
            return new User($user);
        }

        return null;
    }

    public function getUserByEmail(string $email): ?User
    {
        $statement = "SELECT * FROM users WHERE email = :email";

        $result = $this->database->query($statement,['email' => $email]);
        $user = $result->fetch();

        if($user) {
            return new User($user);
        }

        return null;
    }

    public function deleteUserById(int $id): void
    {
        $statement = "DELETE FROM users WHERE Id_users = :id";

        $this->database->query($statement, ['id' => $id]);
    }
}