<?php

session_start();


require('connection.php');
$error = '';

if (isset($_POST['submit'])) {
    if (!empty($_POST['comment'])) {
        $comment = $_POST['comment'];
        $id = $_SESSION['user']['id'];
        $requete = mysqli_query($bdd, "INSERT INTO commentaires(commentaire, id_utilisateur, date) VALUES ('$comment', '$id', NOW())");
        header('Location: livre-or.php');
        var_dump($requete);
    } else {
        $error = 'veuillez remplir le champs';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="book.css">

    <title>Commentaire</title>
</head>

<body>
    <header>
        <h1>Commentaire</h1>
    </header>

    <nav class="crumbs">
    <ol>
        
        <li class="crumb"><a href="index.php">Acceuil</a></li>
        <li class="crumb"><a href="connexion.php">Connexion</a></li>
    </ol>
</nav>

        

        <div class="container">
        
            <p id="postcom">Mettre un Commentaire</p>
            <form action="" method="post">

                <div class="bloc-com">
                    
                    <textarea id="message" name="comment" placeholder="Ecrivez ici..." required></textarea>
                </div>
                <div class="poster">
                    <button type="submit" name="submit" id="comm">Poster</button>
                </div>
            </form>
        </div>
</body>

</html>