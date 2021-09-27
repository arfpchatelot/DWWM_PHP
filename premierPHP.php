<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>


fieldset { width: 30%; }
label { display:inline-block; width:150px; text-align: right;}

#btn_revenu { margin-left: 150pX;}


</style>

<?php
require "models/impot.php ";
//include "models/impot.php ";
if ( isset( $_GET["btn_revenu"])) 
{

        if(!empty($_GET["revenu"] ) &&  !empty($_GET["nom"] ) ) {

            $ObjComptable= new ComptablePublic($_GET["nom"],$_GET["revenu"]);

            $resultatImpot= $ObjComptable->calculImpot();
            

            # code...
        }
        else {
            echo "Veuillez remplir tous les champs, svp! ";
        }


}

 
  
  ?>

       <fieldset>

       <legend>Calcul impôts sur le revenu </legend>
        <form  action="premierPHP.php" method="GET" enctype="text/plain" >

            <label>Nom </label> 
            <input type="text" id="nom" name="nom" value="<?php
             echo( (!empty( $ObjComptable)) ? $ObjComptable->getNom():"");
               ?>"  width="200px" maxlength="50" /><br /><br />
            <label>Revenu annuel</label>
            <input type="number" id="revenu" name="revenu" placeholder="30000" width="50px"  value="<?php echo( (!empty($ObjComptable))? $ObjComptable->getRevenu(): 0 );  ?>" maxlength="30" ><span>€</span> <br /><br />

            <input type="submit" value="calculer" id="btn_revenu" name="btn_revenu" width="100px"  /><br /><br />




        </form>

        <label>Votre impot annuel</label> <input type="text" width="150px" name="impot" id="impot" value="<?php if( !empty($resultatImpot)) { echo $resultatImpot;} else {
            echo 0 ;
        } ?>"   readonly="true" />   

       </fieldset> 


</body>
</html>