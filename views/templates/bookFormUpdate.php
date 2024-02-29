<?php
    $actionForm = Utils::request('action', 'createBookForm');

    if (isset( $_SESSION['bookToBeUpdated'])) {
        $bookToBeUpdated = $_SESSION['bookToBeUpdated'];

        $preFilled = true;
    }
?>

<h2>Modifier les informations</h2>

<form method="POST" action="index.php?action=updatingBook" enctype="multipart/form-data">
    <label for="title">Titre </label>
    <input type="text" id="title" name="title" value="<?=  $preFilled ? $bookToBeUpdated->getTitle()  : '' ?>" minlength="3" maxlength="144" required>

    <label for="author">Auteur </label>
    <input type="text" id="author" name="author" value="<?=  $preFilled ? $bookToBeUpdated->getAuthor()  : '' ?>" minlength="3" maxlength="32" required>

    <label for="description">Commentaire </label>
    <input type="text" id="description" name="description" value="<?=  $preFilled ? $bookToBeUpdated->getDescription() : '' ?>" minlength="50" maxlength="500" required>

    <label for="available">Disponibilité </label>
    <select name="available" id="available" required>
        <option value="">--Veuillez choisir un statut--</option>
        <option <?= $bookToBeUpdated->getAvailable() ? 'selected' : '' ?> value="1">Disponible</option>
        <option <?= !$bookToBeUpdated->getAvailable() ? 'selected' : '' ?> value="0">Non disponible</option>
    </select>

    <input type="file" name="imageToUpload" id="imageToUpload">

    <input type="hidden" name="oldImage" id="oldImage" value="<?= $preFilled ? $bookToBeUpdated->getImage()  : '' ?>">
    <input type="hidden" name="id" id="id" value="<?= $bookToBeUpdated->getId() ?>">
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