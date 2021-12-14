<?php
require('connection.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>Livre-or</title>
</head>

<body>

</body>
<header>
    <h1>Livre d'or</h1>
</header>

    <ol>
        
        <li class="crumb"><a href="index.php">Acceuil</a></li>
    </ol>
</nav>

<main class="container">

    <?php
    $requete = mysqli_query($bdd, "SELECT * FROM commentaires INNER JOIN utilisateurs WHERE utilisateurs.id = commentaires.id_utilisateur
        ORDER BY commentaires.date DESC");
    $commentaires = mysqli_fetch_all($requete);

    foreach ($commentaires as $com) : ?>
        <div class="comments">

            <span>
             <h3><?= $com[5]; ?></h3></span>

            <em><span> le <?= $com[3]; ?></span></em>
            <p class="livre"><?= $com[1]; ?></p>

        <?php endforeach; ?>


</html>