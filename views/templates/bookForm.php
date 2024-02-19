<?php
    $actionForm = Utils::request('action', 'createBookForm');

?>

<h1>Page de <?= $actionForm === 'updateBookForm' ? 'modification d\'un livre' : 'création d\'un livre' ?></h1>

<form method="POST" action="index.php?action=<?= $actionForm === 'createBookForm' ? 'createBook' : 'updateBook' ?>" enctype="multipart/form-data">
    <label for="title">Titre </label>
    <input type="text" id="title" name="title" value="" minlength="3" maxlength="144" required>

    <label for="author">Auteur </label>
    <input type="text" id="author" name="author" value="" minlength="3" maxlength="32" required>

    <label for="description">Commentaire </label>
    <input type="text" id="description" name="description" value="" minlength="50" maxlength="2000" required>

    <label for="available">Disponibilité </label>
    <select name="available" id="available" required>
        <option value="">--Veuillez choisir un statut--</option>
        <option value="available">Disponible</option>
        <option value="not available">Non disponible</option>
    </select>

    <input type="file" name="imageToUpload" id="imageToUpload">

    <input type="submit" value="Valider">
</form>

<?php
    if (isset($emptyError)) {
        echo $emptyError;
    } elseif (isset($formatError)) {
        echo $formatError;
    } elseif (isset($errors)) {
        foreach ($errors as $error => $value) {
            echo $value.'<br/>';
        }
    }
?>