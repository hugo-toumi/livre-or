<?php


require('connection.php');

if(!empty($_POST['password'])&& !empty($_POST['password_confirm'])){


  $login            = $_POST['login']; 

  $password         = $_POST['password']; 

  $password_confirm = $_POST['password_confirm'];
  
  
  if($password != $password_confirm){
    header('location: inscription.php?error=1&pass=1');
        exit();
  }

  $req = $db->prepare("SELECT count(*) as login FROM utilisateurs WHERE login = ?");
  $req->execute(array($login));

  while($login_verification = $req->fetch()){
    if($login_verification['login'] != 0){
      header('location: inscription.php?error=1&login=1');
           exit();
    }
  }
  $req = $db->prepare("INSERT INTO utilisateurs( login, password) VALUES(?,?)");
  $value = $req->execute(array( $login, $password));
		
			
		header('location: connexion.php');
		exit();

}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="book.css">
    <title>Module de Connexion</title>
</head>
<body>
    <header>
      <h1>Inscription</h1>
    </header>

    <div class="container">

    <?php
     
     if(!isset($_SESSION['connect'])){ ?>

  

    <p id="info">Bienvenue sur mon site pour en voir plus, inscrivez vous. Sinon <a href="connexion.php">Connectez-vous</a><p>

    <?php
   
    if(isset($_GET['error'])){
    if(isset($_GET['pass'])){
      echo' <p id="error">Les mots de passe ne sont pas identiques.</p>';
    }
    else if(isset($_GET['login'])){
       echo '<p id="error">Ce nom d utilisateur est deja pris.</p>';
    }
    }
    else if(isset($_GET['success'])){
      echo '<p id="success">Inscription prise correctement en compte.</p>';
    }
    
    ?>

    <div id="form">
    <form action="" method="post">
    <table>
    <tr>
    <td>login</td>
    <td><input type="texte" name="login"
    placeholder="Ex : Nom d'utilisateur"required></td>
    </tr>
    <tr>
    <td>password</td>
    <td><input type="password" name="password"
    placeholder="Ex : *****"required></td>
    </tr>
    <tr>
    <td>password_confirm</td>
    <td><input type="password" name="password_confirm"
    placeholder="Ex : *****"required></td>
    </tr>
    </table>
    <div id="button">
    <button>S'inscrire</button>
    </div>
     </form>
</div>
<?php }else {?>

  <p id="info">Bonjour <?php echo $_SESSION['login'];?></p>

<?php } ?>
</div>    
</body>
</html>