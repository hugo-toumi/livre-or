<?php

require('connection.php');
$message = '';

if (
    !empty($_POST['login'])
    && !empty($_POST['password'])
    && !empty($_POST['password_confirm'])

) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['password_confirm']);

    $requete2 = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE login = '$login'");
    
    $resultat = mysqli_fetch_all($requete2);


    
    if (count($resultat) == 0) {
        if ($password == $confirm_password) {

            
            $requete = mysqli_query($bdd, "INSERT INTO `utilisateurs`(`login`, `password`) VALUES ('$login','$password') ");
            header('Location: connexion.php');
        } else {
            $message = 'les mots de passe ne sont pas identiques';
        }
    } else {
        $message = 'compte déjà existant';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="book.css">
</head>

<body>

    <header>
       <h1>Inscription</h1>
    </header>

    <nav class="crumbs">
    <ol>
        
        <li class="crumb"><a href="index.php">Acceuil</a></li>
        <li class="crumb"><a href="connexion.php">Connexion</a></li>
    </ol>
</nav>

    
        
        <div id="form">
            <form class="form" action="inscription.php" method="post">
                <table>
                    <tr>

                        <td>Login</td>
                        <td><input type="text" name="login" placeholder="Ex : Nom d'utilisateur" required></td>
                    </tr>
                    <tr>

                        <td>Mot de passe</td>
                        <td><input type="password" name="password" placeholder="Ex : *****" required></td>
                    </tr>
                    <tr>

                        <td>Confirmer mot de passe</td>
                        <td><input type="password" name="password_confirm" placeholder="Ex : *****"></td>
                    </tr>

                </table>
                <div id="button">
                    <button type="submit" name="Inscription">Inscription</button>

                    <?php
                    echo "<p class='error'>$message</p>";
                    ?>
                </div>
            </form>
        </div>
       
    
</body>

</html>