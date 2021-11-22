<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Détail du restaurant </title>
    <style>
    input[type='text'] { margin:15px 20px; background-color:#E6E6E6;  }
	input[type='password'] { margin:15px 20px; background-color:#E6E6E6;  }
	label { margin-left:10px;margin-right:10px}
	fieldset {margin-top:50px; width:15%; margin-left:auto; margin-right:auto;}
	#btnsub { width:100%;text-align:center}
	
    </style>
  </head>

<body>


<?php
 include ( "models/table.php");
 
if(isset($_GET["id"]) && !empty($_GET["id"]))
{ 
	
$monObjetTable= new Mytable("restaurants");
$rows=$monObjetTable->chercherLigne("id",$_GET["id"]);
//echo var_dump($rows); 
//affichage sous forme de tableau de la ligne renvoyée au cas ou cela marche...
if(!empty($rows))
{ 
echo "<p> Nombre de ligne du tableau de résultat:".sizeof($rows)."</p>"; 

//affichage de la première ligne uniquement
 
echo '<caption>Première ligne trouvée...</caption><table class="table table-dark table-hover"  ><tr>';
	
		for($i=0;$i<count($rows[0]);$i++)
		{
		
			if($i==3)
					{
								echo"<td>".$rows[0][$i]."€</td>";
						}
							else
							{
							echo"<td>".$rows[0][$i]."</td>";
							
							}
			} 

echo "</tr></table>";


 
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
		echo " fiche détail non trouvée";}

}
else

{echo " fiche détail introuvable manque d'information" ;

  
	 echo '<br><div class="form-group form-button" id="btnsub" >
  <input type="button" class="btn btn-primary" id="retour" name="retour" value="Retour au listing" />
</div>';

echo"<script>
creation=document.getElementById('retour');
    creation.addEventListener('click', function () { window.location.href='afficher_guide.php';}); 
</script>";
	
	}


?>



 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>