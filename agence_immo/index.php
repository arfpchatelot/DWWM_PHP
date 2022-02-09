

<?php
/* HEADER entete avec dépendances CSS 
  ================================================== */
include( "header.php");
 
 
 /*NAVBAR
    ================================================== */
include("menu.php");

 /* Carousel
    ================================================== */

include("slider.php");

require("./models/connection.php");
   /*  Marketing mainpage 
    ================================================== 
   Wrap the rest of the page in another container to center all the content. */

   
   if(isset($_GET["lib_cat"]))
   { 
   $categorie=$_GET["lib_cat"];}
   else {

	$categorie="";
   }
	    
		 echo'<h1>Liste des biens immobiliers</h1>';
		 
		
		 
		  echo'<form  action="index.php" method="GET" >
				 <fieldset><legend>Rechercher un Bien immobilier</legend>
				 
				  <div class="form-group">
 <input type="hidden" name="lib_cat" value="'.$categorie.'" id="lib_cat" />
 
 <label for="dept">Choisir le département</label>';
 
 echo '<select name="dep"  id="dep" class="form-control"  style=" max-width:300px"><option value="">Choisissez votre département</option> ';

  	$connect2=maConnection::getInstance();
	   $rq2="select * from departements where dep_actif=1";
	   $state= $connect2->prepare($rq2);
	   $state->execute();
	   while ($ligne= $state->fetch(PDO::FETCH_ASSOC)) 
	   {
		   # code...
			echo"<option value='".$ligne["id_dep"]."'>".$ligne["nom_dep"]."</option>";  

	   }


 echo '</select>';
 echo' </div>
 <div class="form-group">
 
 <label for="budget">Montant budget maximum</label>
 	<span class="currencyinput">€
<input type="number"  step="10000" id="bugdet" name="budget" placeholder="Budget Max"  min="50000" max="900000000" />
</span>
</div>

<div class="form-group">
 <label for="nbpiece" >Nombre de pièces souhaitées:</label>';
 
 echo '<select name="nbpieces"  id="nbre" class="form-control"  style=" max-width:300px"><option value=" " >Choisissez le nombre de pièce</option>';
     $connect3=maConnection::getInstance();
     $rq3="select distinct nbr_pieces from biens_immobiliers";
	 $state=$connect3->prepare($rq3);
	 $state->execute();
	 while ($ligne= $state->fetch(PDO::FETCH_ASSOC)) {
		 
		if( isset($_GET["nbpieces"]) && $ligne["nbr_pieces"]==$_GET["nbpieces"] )
  {
	echo "<option value='".$ligne["nbr_pieces"]."' selected='selected' >".$ligne["nbr_pieces"]." pièce(s)</option>";


  }  else
  {
	echo "<option value='".$ligne["nbr_pieces"]."' >".$ligne["nbr_pieces"]." pièce(s)</option>";


  }
  

	 }

echo"</select></div>";
  
 echo  '
         <div class="form-group form-button" id="btnsub" >				  
 <button type="submit" class="btn btn-primary" name="envoi">Submit</button>
	</div>
	</fieldset>
	 </form>'; 

	 //$categorie à definir en fonction de la catégorie de bien choisie dans le formulaire.       
	
	
	 //$rq= "select * from biens_immobiliers inner join categories on categories.id_categorie=biens_immobiliers.id_categorie  where lib_categorie=".$categorie; 
	
	switch ($categorie) {
		case 'appartement':
			$rq= "select * from biens_immobiliers where id_categorie=1";
			break;
		case 'maison individuelle':
	
			$rq= "select * from biens_immobiliers where id_categorie=2";
		 break;
	
		case 'terrain':
			$rq= "select * from biens_immobiliers where id_categorie=3";
			break;
	
		case "local professionnel":
			$rq= "select * from biens_immobiliers where id_categorie=4";
			break;
			
		default :
			$rq ="select * from biens_immobiliers";
			break;
		   }
	
			$connect=maConnection::getInstance();
				 $state=$connect->prepare($rq);
					   
				 $state->execute();
	

	   	 $tab= $state->fetchAll();

		 $nom_cols=[];	
	    if( sizeof($tab)>0 )
	   	{	
			$ligne=$tab[0];
			for ($i=0; $i <count($ligne) ; $i++) { 
				
					$tabinfo=$state->getColumnMeta($i);
					array_push($nom_cols, $tabinfo["name"]);

			}
		}
		else
		{
			echo "<p style='width:100%;text-align:center' >Aucun résultat n'a été trouvé!...</p>";
		}
	   

				//<tr><th>titre</th><td>nbr_pieces</td><td>Part amortissement</td><td>Capital restant dû</td><td>Mensualité</td></tr>/
				echo "<table  class='table table-striped' ><thead><tr>";
						
				//	var_dump($nom_cols);
					for ($i=1; $i <count($nom_cols) ; $i++) { 
						echo"<th>".$nom_cols[$i]."</th>";
					}



				echo"</tr></thead><tbody>";
	   		
			


	   	foreach ($tab as $ligne) {
		    // var_dump($ligne);
				echo"<tr>";
				for ($i=1; $i<=15 ; $i++) { 
					echo "<td>".$ligne[$i]."</td>";
				}

				echo "</tr>";
		   }

		   echo "</tbody></table>";
		
			
include( "acces_membre.php");  
		  
		  
		  
/* Pied de page avec dépendances Javascript...
    ================================================== */
 include( "footer.php");
		  
		  ?>
          
   


