<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<?php
   spl_autoload_register(function($class) {include  "models/".$class.".php";} );

  
   
   $tab_input=[ 
    "genre"=>"integer", 
   "login"=>"string",
    "pass"=>"string",
    "confirmpass"=>"string"
                ];

                if (isset($_POST["btn_validation"])) 
                
                {
                 $ObjValidation= new FormValidation($tab_input);
                 
                 if($ObjValidation->isFilled()) {

                    if($ObjValidation->isValid())
                    { 
                      
                      echo var_dump($_POST);  
                    
                    }
                    else {
                      echo "Saisie non conforme, veuillez remplir les champs correctement!!!";
                    }

                    

                    
                 }
                 else {
                   echo "Veuillez remplir tous les champs !!!";
                 }


                }





?>


<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data" >

<fieldset>
<legend>Inscription </legend>
<select name="genre" id="genre" min-width="200px" >  
 <option value="test"  selected="selected">Genre</option>   
<option value="10" >M.</option>
<option value="20">Mme</option>
<option value="30">Mlle</option>
</select><br/><br/>

<hr/>
<label>Identifiant</label> 
<input type="text" id="login" name="login" value="" maxlength="50" /><br /><br />
     <label>Choisissez votre Mot de passe</label>
     <input type="password" id="pass" name="pass"  value=""  minlength="8"  /> <br /><br />
     <label>Confirmer votre mot de passe</label>
     <input type="password" id="confirmpass" name="confirmpass"  value=""  minlength="8"  /> <br /><br />
    
    <input type="submit" value="Valider" id="btn_validation" name="btn_validation" /> 

</fieldset>


</form>
    
</body>
</html>