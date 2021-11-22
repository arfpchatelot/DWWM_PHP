<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Ajouter critique</title>
    <style>
    input[type='text'] { margin:15px 20px; background-color:#E6E6E6;  }
	input[type='date'] { margin:15px 20px; background-color:#E6E6E6;  }
	label { margin-left:10px;margin-right:10px}
	fieldset {margin-top:50px; width:70%; margin-left:auto; margin-right:auto;}
	#btnsub { width:100%;text-align:center}
	
    </style>
     </head>
  
  <body>
  
  <?php
  include ("models/table.php");
  if(isset($_POST["valider"]) )
  
  {  
   $matable= new Mytable("restaurants");
  
  $insertionligne=$matable->insertionligne(addslashes($_POST["nom"]),addslashes( $_POST["adresse"]),$_POST["prix"],addslashes($_POST["commentaire"]), $_POST["note"],$_POST["visite"]); 
  
  if($insertionligne==1)
  	{ 
  echo "critique insérée";
	 echo '<br><div class="form-group form-button" id="btnsub" >
  <input type="button" class="btn btn-primary" id="retour" name="retour" value="Retour au listing" />
</div>';

echo"<script>
creation=document.getElementById('retour');
    creation.addEventListener('click', function () { window.location.href='afficher_guide.php';}); 
</script>";

	} 
	else
	  {
	echo" problème technique";
	
	 echo '<br><div class="form-group form-button" id="btnsub" >
  <input type="button" class="btn btn-primary" id="retour" name="retour" value="Retour au listing" />
</div>';

echo"<script>
creation=document.getElementById('retour');
    creation.addEventListener('click', function () { window.location.href='afficher_guide.php';}); 
</script>";
	
	
	 }
   
  
  } 
  
  else 
  {
  echo'<form  action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">
				 <fieldset><legend>Ajouter une critique d\'établissement</legend>	
 <div class="form-group">
 <label for="nom">Nom restaurant</label>
 		
<input type="text" class="form-control"  id="nom" name="nom" placeholder="nom" />

</div>
 <div class="form-group">
 <label for="nom">Adresse restaurant</label>
 		<input type="text" class="form-control"  id="adresse" name="adresse" placeholder="adresse" />
</div>

<div class="form-group">
 <label for="prix" >prix moyen repas: </label>
						
  <input class="form-control" type="number" id="prix" name="prix" value="" placeholder="prix"  />
  </div>
  </div>
 <div class="form-group">
 <label for="nom">Commentaire restaurant</label>
 		<textarea class="form-control"  id="commentaire" name="commentaire" >Votre commentaire</textarea>
</div>
<div class="form-group">
 <label for="note" >Note restaurant: </label>
						
  <input class="form-control" type="number" id="note" name="note" value="" placeholder="votre note"  />
  </div>
  
  <div class="form-group">
 <label for="date" >Date visite du restaurant:( client mystère) </label>
						
  <input class="form-control" type="date" id="visite" name="visite" value="" placeholder=""  />
  </div>
                     
	<div class="form-group form-button" id="btnsub" >				  
 <button type="submit" class="btn btn-primary" name="valider" >Submit</button>
	</div>
	</fieldset>
	 </form>'; 
  }
  
  ?>
  
  
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>