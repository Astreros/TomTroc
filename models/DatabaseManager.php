<?php

    /**
     * Cette Classe permet de se connecter à la base de données.
     * La Classe DatabaseManager est un singleton.
     * Pour récupérer une instance de cette classe, il faut utiliser la méthode getInstance()
     *
     * @author dpierru
     */
    class DatabaseManager
    {
        private static $instance;
        private $database;

        private  function __construct()
        {
            // Connexion à la base de données.
            $this->database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            // Definition du mode pour reporter les erreurs de PDO = lance des PDOExceptions.
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Definition du mode de récupération = retourne un tableau indexé.
            $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        /**
         * Méthode qui permet de récupérer l'instance de la classe DBManager.
         * @return DatabaseManager
         *
         * @author dpierru
         */
        public static function getInstance(): DatabaseManager
        {
            if (!self::$instance) {
                self::$instance = new DatabaseManager();
            }
            return self::$instance;
        }

        /**
         * Renvoie l'objet PDO utilisé par la base de données.
         *
         * @return PDO
         *
         * @author dpierru
         */
        public function getPDO(): PDO
        {
            return $this->database;
        }

        /**
         * Exécute une requête SQL avec des paramètres facultatifs et renvoie l'objet PDOStatement résultant.
         *
         * @param string $sql La requête SQL à exécuter.
         * @param array|null $params Un tableau associatif de paramètres. Chaque clé représente un paramètre dans la requête SQL et sa valeur correspondante.
         * @return PDOStatement L'objet PDOStatement résultant de la requête SQL.
         *
         * @author dpierru
         */
        public function query(string $sql, ?array $params = null): PDOStatement
        {
            if ($params === null) {
                $query = $this->database->query($sql);
            } else {
                $query = $this->database->prepare($sql);
                $query->execute($params);
            }

            return $query;
        }
    }