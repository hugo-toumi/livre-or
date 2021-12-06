<?php
require_once 'message.php';
require_once 'GuestBook.php';
$errors = null;  
$success = false;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if(isset($_POST['login'], $_POST['message'])){
    $message = new message($_POST['login'], $_POST['message']);
    if($message->isValid()) {

        
        $guestbook->addMessage($message);
        $success = true;
        $_POST = [];

    } else {
        $errors = $message->getErrors();
    }

}

$messages = $guestbook->getMessages();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
</head>
<body>

<div class="container">
<h1>Livre d'or</h1>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    Formulaire invalide
</div>
    <?php endif ?>


    <?php if ($success): ?>
<div class="alert alert-success">
    Merci de votre message !
</div>
    <?php endif ?>
    

        <form action="" method="post">
    <div class="form-group">
    <input  value="<?= $_POST['login'] ?? '' ?>" type="texte" name="login" placeholder="Votre login" <?= isset($errors['login']) ? 'is-invalid' : '' ?>>
    <?php if (isset($errors['login'])): ?>
        <div class="invalid-feedback"><?= $errors['login'] ?></div>
    <?php endif ?>
</div>
    <div class="form-group">
    <textarea  name="message" placeholder="Votre message" <?= isset($errors['message']) ? 'is-invalid' : '' ?>><?= $_POST['message'] ?? '' ?></textarea>
    <?php if (isset($errors['message'])): ?>
        <div class="invalid-feedback"><?= $errors['message'] ?></div>
    <?php endif ?>
</div>
    <button class="btn btn-primary">Envoyer</button>
</form>
<?php if (!empty($messages)): ?>
<h1 class="mt-4">Vos Messages</h1>

<?php foreach($messages as $message): ?>

<?= $message->toHTML() ?>

<?php endforeach ?>

<?php endif ?>
</div>    
</body>
</html>