
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Inscription festival du vin</title>
<!--Elements <meta />  -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<?php

class maConnection {
    
    private static $connection = null;
    private  $host='localhost';
    private  $user='root';
    private  $pass='';
    private  $base='festival';
    
    private function __construct() {
        
    }

    
	static public final function getInstance() {
        if (is_null(self::$connection)){
			try {
              self::$connection=new PDO('mysql:host=localhost;dbname=festival','root','', array(
					 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_CASE => PDO::CASE_LOWER,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    ));
			}
			 catch(PDOException $e) {
					die("Database connection failed: " . $e->getMessage());
					
				echo "erreur connexion";  
			}
             
        }   

        return self::$connection;     
    } 
   }
$affiche=true;
  
if (isset($_POST["envoi"]))
{
if(
       isset($_POST["nom_cli"]) && !empty($_POST["nom_cli"]) and 
   isset($_POST["prenom_cli"]) && !empty($_POST["prenom_cli"]) and
   isset($_POST["mail_cli"]) && !empty($_POST["mail_cli"]) and 
   isset($_POST["mdp_cli"]) && !empty($_POST["mdp_cli"]) and
   isset($_POST["verif_mdp"]) && !empty($_POST["verif_mdp"]) and 
   isset($_POST["dept"]) && !empty($_POST["dept"]) and
   isset($_POST["age_cli"]) && !empty($_POST["age_cli"]))
  {

        $nom=trim($_POST['nom_cli']);
        $prenom=trim($_POST["prenom_cli"]);
        $email=trim($_POST["mail_cli"]);
      
        $dep= trim($_POST["dept"]);
        $age=trim($_POST["age_cli"]);

      if($_POST["mdp_cli"] == $_POST["verif_mdp"])
      {
        $pass = password_hash($_POST['mdp_cli'],PASSWORD_BCRYPT);

        $bd =  maConnection::getInstance();
        $pdoStat = $bd->prepare('INSERT INTO candidats VALUES (id_user,:nom, :prenom, :email, :pass,:dep ,:age)');

            $pdoStat->bindParam(':nom',$nom,PDO::PARAM_STR);
            $pdoStat->bindParam(':prenom',$prenom,PDO::PARAM_STR);
            $pdoStat->bindParam(':email',$email,PDO::PARAM_STR);
            $pdoStat->bindParam(':pass',$pass,PDO::PARAM_STR);
            $pdoStat->bindParam(':dep',$dep,PDO::PARAM_INT);
            $pdoStat->bindParam(':age',$age,PDO::PARAM_INT);
 
        //éxécution de la requete préparée

         $vrai =  $pdoStat->execute();

            if($vrai)
            { $affiche=false;
                 echo 'Votre inscription à bien été validée, nous allons vous contacter prochainement';
            }
            else
            {
                //header('location:inscription.php');
                echo'Erreur , veuillez recommencer';
            }

      }
      else
      {
       /* header('location:inscription.php');*/
        echo'Le mot de passe doit être identique';
      }
  }
  else
  {
  //  header('location:inscription.php');
    echo'Veuillez remplir tout les champs';
  }

} 


if($affiche==true)
{
?>

<form action="<?php  echo $_SERVER['PHP_SELF'] ?>"  method="POST" enctype="multipart/form-data" >

<fieldset><legend>Inscription Candidat<br/>Jeux concours</legend> 
<label class="lbl" >Nom</label>
<input type="text" name="nom_cli" id="nom_cli" placeholder="votre nom" maxlength="100" class="txt" />
<label class="lbl" >Prénom</label>
<input type="text" name="prenom_cli" id="prenom_cli" placeholder="votre prenom" maxlength="50" class="txt" />
<label class="lbl" >Mail</label>
<input type="email" name="mail_cli" id="mail_cli" placeholder="identifiant"  class="txt" />
<label class="lbl" >mot de passe</label>
<input type="password" name="mdp_cli" id="mdp_cli"   class="txt" />
<label class="lbl" > Verification mot de passe</label>
<input type="password" name="verif_mdp" id="verif_mdp"   class="txt" />
<label class="lbl" >Département de votre domicile principal</label>
<select name="dept" id="dept" >
<option  value="" >Choisir un département</option>
<?php


/*try {
   $dsn="mysql:host=localhost;dbname=festival";
    $connexion= new PDO($dsn,'root','', [  
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_CASE => PDO::CASE_LOWER,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
     ]);
  
} catch (Exception $e)
 {

    die('Erreur :'.$e->getMessage());
}*/
$connexion = maConnection::getInstance();
$req="select id_dep,Name from departements";
    $state=$connexion->prepare($req);
    $state->execute();
    while ($ligne=$state->fetch()) {

         echo '<option value="'.$ligne["id_dep"].'" >'.$ligne["name"].'</option>';
      
    }


?>
</select>
<br/>
<br/>
<label class="lbl" >Age</label>
<input type="number" name="age_cli" id="age_cli" placeholder="18"  class="txt" />

<input type="submit" name="envoi" id="envoi" value="Valider" > 
 
<?php } ?>

<!-- <button type="submit" name="envoi" id="envoi" >Valider</button>-->
</fieldset>
</form>    
</body>
</html>