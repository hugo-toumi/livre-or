<?php
session_start();
$error = "";

require('connection.php');


if (isset($_POST['modif'])) {
    

    $id = $_SESSION['user']['id'];
    $newlogin = htmlspecialchars($_POST['login']);
    $newpassword = htmlspecialchars($_POST['password']);
    $newpassword_confirm = htmlspecialchars($_POST['password_confirm']);


    
    if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['password_confirm'])) {

        $error = "veuillez remplir ce champs";
    } else {
       
        if ($newpassword != $newpassword_confirm) {
            $error = "Les mots de passe ne sont pas identiques.";
        } else {
            
            $requete2 = "UPDATE utilisateurs SET login = '$newlogin', password = '$newpassword' WHERE id = $id";
            $modifprofil = mysqli_query($bdd, $requete2);

            
            if ($modifprofil == true) {

        
                $query = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id = $id");
                $resultat = mysqli_fetch_assoc($query);
                $_SESSION['user'] = $resultat;

                header('location: connexion.php');
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="book.css">
</head>

<body>
    <header>

    <h1>Profil</h1>
        
    </header>

    <nav class="crumbs">
    <ol>
        
        <li class="crumb"><a href="index.php">Acceuil</a></li>
        <li class="crumb"><a href="connexion.php">Connexion</a></li>
        <li class="crumb"><a href="commentaire.php">Mettre un commentaire</a></li>
    </ol>
</nav>

    
        <div id="form">
            <form class="form" action="profil.php" method="post">
                <table>
                    <tr>

                        <td>Nouveau Login<?php $_SESSION['user']['login']; ?></td>
                        <td><input type="text" name="login" value="<?php echo $_SESSION['user']['login']; ?>"></td>
                    </tr>
                    <tr>

                        <td>Nouveau Mot de passe</td>
                        <td><input type="password" name="password" placeholder="Ex : *****"></td>
                    </tr>
                    <tr>

                        <td>Confirmer nouveau mot de passe</td>
                        <td><input type="password" name="password_confirm" placeholder="Ex : *****"></td>
                    </tr>
                </table>
                <div id="button">
                    <button type="submit" name="modif">Mettre a jour</button>
                </div>
            </form>


        </div>
        <p>
            <?php echo $error; ?>
        </p>
</body>

</html>