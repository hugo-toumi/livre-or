<?php
require('connection.php');
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
    <link rel="stylesheet"  href="book.css">
    <title>Livre d'or</title>
</head>
<body>

<header>
		<h1>Livre d'or</h1>
	</header>

    <nav class="crumbs">
    <ol>
        
        <li class="crumb"><a href="index.php">Acceuil</a></li>
    </ol>
</nav>

<div class="container">


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
    

    
<?php if (!empty($messages)): ?>
<h1 class="mt-4">Livre d'or</h1>

<?php foreach($messages as $message): ?>

<?= $message->toHTML() ?>

<?php endforeach ?>

<?php endif ?>
</div>    
</body>
</html>
