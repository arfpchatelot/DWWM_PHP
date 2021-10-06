<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Authentification</title>
</head>

<body>

    <fieldset>
        <legend>S'identifier</legend>
        <?php
        session_start();
        $tab = array(
            
            "admin" => password_hash("Cdi1234", PASSWORD_BCRYPT),
            "ahaddock" => password_hash("Ondine", PASSWORD_BCRYPT)
        );
        if (isset($_GET["btn_ok"])) {

            if (!empty($_GET["login"]) && !empty($_GET["mdp"])) {
                $trouve = false;
                foreach ($tab as $key => $val) {
                    if ($key == $_GET["login"] && password_verify($_GET["mdp"], $val)) {

                        $trouve = true;
                        break;
                    }
                }
                if ($trouve == true) {
                    $_SESSION["pseudo"] = $_GET["login"];
                    header('Location: info.php');
                } else {

                    echo "Login ou mdp incorrects veuillez recommencer ! ";
                }
            } else {
                echo " Champs vides, veuillez remplir tous les champs svp !";
            }

            // code... test de fonctionnement
        }



        echo ' <form  action="index.php" method="GET" enctype="text/plain" >

     <label>Identifiant</label> 
     <input type="text" id="login" name="login" value=""   maxlength="50" /><br /><br />
     <label>Mot de passe</label>
     <input type="password" id="mdp" name="mdp"  value=""  minlength="4"  /> <br /><br />

     <input type="submit" value="OK" id="btn_ok" name="btn_ok" width="80px"  /><br /><br />


 </form>';

        ?>



    </fieldset>




</body>

</html>