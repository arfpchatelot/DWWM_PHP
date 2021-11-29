<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Acces membres Voiliers</title>
    <!--Elements <meta />  -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript"> </script>
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>
<a href="liste.php" target="_blank">Accès liste voiliers disponibles</a>
    <?php
    session_start();
    $affiche=true;
    class maConnection
    {

        private static $connection = null;
        private  $host = 'localhost';
        private  $user = 'root';
        private  $pass = '';
        private  $base = 'voiliers';

        private function __construct()
        {
        }


        static public final function getInstance()
        {
            if (is_null(self::$connection)) {
                try {
                    self::$connection = new PDO('mysql:host=localhost;dbname=voiliers', 'root', '', array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_CASE => PDO::CASE_LOWER,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    ));
                } catch (PDOException $e) {
                    die("Database connection failed: " . $e->getMessage());

                    echo "erreur connexion";
                }
            }

            return self::$connection;
        }
    }

    if (isset($_POST["validation"])) {

        if (!empty($_POST["login"]) && !empty($_POST["mdp"])) {
            echo "test";
            $rq = "SELECT * FROM utilisateurs where mail_user=:mail";

            $connect = maConnection::getInstance();
            $state = $connect->prepare($rq);
            $state->bindParam(":mail", $_POST['login'], PDO::PARAM_STR);
            $state->execute();
            $numrow = $state->rowCount();
            if ($numrow > 0) {
                $ligne = $state->fetch();
                if (password_verify($_POST["mdp"], $ligne[4]) == true) {
                    $_SESSION["login"] = $ligne[3];
                    echo "accès ok";
                    $affiche=false;
                } else {

                    echo "Mauvais mot de passe !";
                }
            } else {

                echo "Mauvais login !";
            }
        } else {

            echo "veuillez-remplir tous les champs";
        }
    } 

    if( $affiche ==true)
    {

    ?>

   

  
    <form action="<?php $_SERVER['PHP_SELF'];  ?>" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>ACCES MEMBRES</legend>
            <label>Email</label>
            <input type="email" name="login" id="login">
            <label> Mot de passe</label>
            <input type="password" name="mdp" id="mdp" maxlength="30">
            <input type="submit" value="Valider" name="validation" id="validation">
        </fieldset>

    </form>
    <?php 
    }
    else {
        echo '<input type="button" value="Deconnexion" name="off" id="off">';     

    }
    ; ?>
</body>
</html>