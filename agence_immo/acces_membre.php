<style>
.text-on-pannel {
  background: #fff none repeat scroll 0 0;
  height: auto;
  margin-left: 20px;
  padding: 3px 5px;
  position: absolute;
  margin-top: -47px;
  border: 1px solid #337ab7;
  border-radius: 8px;
}

.panel {
  /* for text on pannel */
  margin-top: 27px !important;
}

.panel-body {
  padding-top: 30px !important;
} 
</style>

 <?php
 

  require_once("models/connection.php");
 
 if(isset($_POST["identifiant"]) && !empty($_POST["identifiant"]) and isset($_POST["pwd"]) and !empty($_POST["pwd"]))
 
 {
	  //echo "test";
	  $connect=maConnection::getInstance();
	 $rq="Select nom_utilisateur,prenom_utilisateur,pass_utilisateur,id_niveau from utilisateurs where mail_utilisateur=:identifiant";
	 $state=$connect->prepare($rq);
	 
	 $state->bindParam(":identifiant",$_POST["identifiant"],PDO::PARAM_STR);
	 $state->execute();
	 $ligne=$state->fetch(PDO::FETCH_ASSOC);
	// echo var_dump($ligne);
	 
	 if( password_verify($_POST["pwd"],$ligne["pass_utilisateur"])==true)
	 {
	  echo "bravo vous êtes connecté";
	  
	  $_SESSION["nom_user"]=$ligne["nom_utilisateur"];
	   $_SESSION["prenom_user"]=$ligne["prenom_utilisateur"];
	    $_SESSION["mail_user"]=$_POST["identifiant"];
		$_SESSION["niveau_user"]=$ligne["id_niveau"];
	  
	 
	 }
	 else
	 {
		 echo "Identifiant ou mot de passe incorrect!";
		 
		 }
 }



 
 
   echo'
   
   <div class="container">
  <div class="panel panel-primary">
    <div class="panel-body">
      <h3 class="text-on-pannel text-primary"><strong class="text-uppercase"> Accès gestion</strong></h3>
     
    
   <form id="verif"  name="verif" action="'.$_SERVER['PHP_SELF'].'" method="POST" >
					
 <p style="text-align:center;"><label style="font-family:Verdana, Geneva, sans-serif" for="identifiant"> email  </label>
 
 <input  class="form-control"  id="identifiant" name="identifiant" value="" type="text"></p>
 
 <p style="text-align:center; "><label  style="font-family:Verdana, Geneva, sans-serif" for="pwd" >Mot de passe : </label>
   <input class="form-control" type="password" id="pwd" name="pwd" value="" /></p>
                        <p style="text-align:center; width:100%">
						<input type="submit" class="btn btn-primary" id="validation" name="validation" value="Valider" style=" text-align:center"  ></p>
                   </form>
				   </div>
  </div>
  <div>';
				   
?>