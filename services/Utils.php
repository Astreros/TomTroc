<?php

use JetBrains\PhpStorm\NoReturn;

class Utils
{
    /**
     * Cette méthode permet de récupérer une variable de la super-globale $_REQUEST.
     *
     * Si cette variable n'est pas définie, on retourne la valeur null.
     * Si oui, elle est passée en paramètre.
     *
     * @param string $variableName Le nom de la variable à récupérer.
     * @param mixed $defaultValue La valeur par défaut si la variable n'est pas définie.
     * @return mixed La valeur de la variable ou la valeur par défaut.
     *
     * @author dpierru
     */
    public static function request(string $variableName, mixed $defaultValue = null): mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    /**
     * Cette méthode redirige l'utilisateur vers une action spécifiée avec des paramètres facultatifs.
     *
     * @param string $action L'action que l'on veut faire. Cel correspond aux actions dans le routeur.
     * @param array $params Les paramètres de l'action sous forme d'un tableau associatif.
     * @return void
     *
     * @author dpierru
     */
    #[NoReturn] public static function redirect(string $action, array $params = []): void
    {
        $url = "index.php?action=$action";

        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }

        header("Location: $url");
        exit();
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public static function redirectWithoutParamsInUrl(string $action, array $params = []): void
    {
        $view = new View($action);

        $view->render($action, $params);
        exit();
    }

    /**
     * Cette méthode permet de formater une chaîne de caractères en la protégeant contre les attaques XSS.
     *
     * La chaîne de caractères est protégée en utilisant la fonction htmlspecialchars().
     * Ensuite, la chaîne est découpée en lignes en utilisant le caractère de retour à la ligne "\n".
     * Chaque ligne est ensuite reconstruite dans un paragraphe HTML en ignorant les lignes vides.
     *
     * Le résultat final est retourné.
     *
     * @param string $string La chaîne de caractères à protéger et formater.
     * @return string La chaîne de caractères protégée et formatée.
     *
     * @author dpierru
     */
    public static function protectedStringFormat(string $string): string
    {
        // On protège le texte avec htmlspecialchars().
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        // Découpage du texte par rapport aux retours à la ligne.
        $lines = explode("\n", $finalString);

        // Reconstruction de chaque ligne dans un paragraphe et en sautant les lignes vides.
        $finalString = "";

        foreach ($lines as $line) {
            if (trim($line) !== "") {
                $finalString .= "<p>$line</p>";
            }
        }

        return $finalString;
    }

    public static function checkIfUserIsConnected(): void
    {
        if(!isset($_SESSION['user'])) {
            self::redirect("loginForm");
        }
    }

    public static function uploadImageFile(array $image, string $category, string $directory): array
    {
        $imageFileType = pathinfo($image['name'], PATHINFO_EXTENSION);
        $imageName = uniqid($category, true) . '.' . $imageFileType;
        $imagePath = $directory . $imageName;

        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            $error = error_get_last();
            return [
                'success' => false,
                'message' => "Erreur lors du téléchargement du fichier : " . $error['message']
            ];
        }

        return [
            'success' => true,
            'message' => $imagePath
        ];
    }

    public static function deleteImageFile($imageName): void
    {
        if(file_exists($imageName)) {
            unlink($imageName);
        }
    }

    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }
}