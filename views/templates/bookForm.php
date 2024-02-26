<?php
    $actionForm = Utils::request('action', 'createBookForm');

    $title = null;
    $author = null;
    $description = null;
    $available = null;
    $image = null;
    $id = null;
    $preFilled = false;

    if (isset($bookToBeUpdated)) {
        $title = strip_tags($bookToBeUpdated->getTitle());
        $author = strip_tags($bookToBeUpdated->getAuthor());
        $description = strip_tags($bookToBeUpdated->getDescription());
        $available = strip_tags($bookToBeUpdated->getAvailable());
        $id = strip_tags($bookToBeUpdated->getId());
        $image = strip_tags($bookToBeUpdated->getImage());

        $oldImage = strip_tags($bookToBeUpdated->getImage());

        $preFilled = true;
    }
?>

<h1>Page de <?= $actionForm === 'updateBookForm' ? 'modification d\'un livre' : 'création d\'un livre' ?></h1>

<form method="POST" action="index.php?action=<?= $actionForm === 'createBookForm' ? 'createBook' : 'updatingBook' ?>" enctype="multipart/form-data">
    <label for="title">Titre </label>
    <input type="text" id="title" name="title" value="<?=  $preFilled ? $title  : '' ?>" minlength="3" maxlength="144" required>

    <label for="author">Auteur </label>
    <input type="text" id="author" name="author" value="<?=  $preFilled ? $author  : '' ?>" minlength="3" maxlength="32" required>

    <label for="description">Commentaire </label>
    <input type="text" id="description" name="description" value="<?=  $preFilled ? $description : '' ?>" minlength="50" maxlength="500" required>

    <label for="available">Disponibilité </label>
    <select name="available" id="available" required>
        <option value="">--Veuillez choisir un statut--</option>
        <option <?= $available ? 'selected' : '' ?> value="true">Disponible</option>
        <option <?= !$available ? 'selected' : '' ?> value="false">Non disponible</option>
    </select>

    <input type="file" name="imageToUpload" id="imageToUpload">

    <input type="hidden" name="oldImage" id="oldImage" value="<?= $preFilled ? $image  : '' ?>">
    <input type="hidden" name="id" id="id" value="<?= $id ?>">
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