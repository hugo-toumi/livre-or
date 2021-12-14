<?php
session_start();
$error = '';


if (isset($_POST['connexion'])) {

    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    if ($login != NULL && $password != NULL) {
        
        require('connection.php');
        
        $requete = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$login'");
        $resultat = mysqli_fetch_assoc($requete);

        if ($password == $resultat['password']) {

            $_SESSION['user'] = $resultat;
            header('location: profil.php');
        } else {

            $error = "Le login ou le mot de passe est incorrect";
        }
    } else {
        $error = 'erreur';
    }
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="book.css" />
</head>

<body>
    <header>
        <h1>Connexion</h1>
    </header>

	<nav class="crumbs">
    <ol>
        
        <li class="crumb"><a href="index.php">Acceuil</a></li>
        <li class="crumb"><a href="deconnexion.php">Deconnexion</a></li>
    </ol>
</nav>

    
        <div id="form">
            <form class="form" action="connexion.php" method="post">
                <table>
                    <tr>

                        <td>Login</td>
                        <td><input type="text" name="login" placeholder="Ex : Hugo" required></td>
                    </tr>
                    <tr>

                        <td>Mot de passe</td>
                        <td><input type="password" name="password" placeholder="Ex : *****" required></td>
                    </tr>

                </table>
                <div id="button">
                    <button type="submit" name="connexion">Connexion</button>
                </div>
            </form>
            <p class="error">
                <?php echo $error;   ?></p>
        </div>

   
</body>

</html>