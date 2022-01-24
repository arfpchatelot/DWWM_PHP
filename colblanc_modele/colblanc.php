<!doctype html>
<html lang="Fr">

<head>
  <meta charset="utf-8">
  <title>Entrainement Centre de Readaptation</title>
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

  <div id="page">
    <div id="header">
      <img src="contenu/header.jpg" width="980" height="176" alt="colblanc entete">
    </div>

    <div id="menu">
      <ul>
        <li><a href="#">Entreprises</a>
          <ul>
            <li><a href="#" target="_self">Visualiser</a>
            </li>
            <li><a href="filtre.php">Rechercher</a>
            </li>
            <li><a href="#">Ajouter</a>
            </li>
          </ul>
        </li>
        <li><a href="#">Candidats</a>
          <ul>
            <li><a href="#" target="_self">Listing</a>
            </li>
            <li><a href="#">rechercher</a>
            </li>
            <li><a href="#">Ajouter</a>
            </li>
            <li><a href="#">CVthèque</a>
            </li>
          </ul>
        </li>
        <li><a href="#">Projets</a>

        </li>
        <li><a href="#">offres</a>
          <ul>

            <li><a href="#">Par secteur</a>

            </li>

            <li><a href="#">Par entreprises</a>

            </li>
          </ul>
        </li>
      </ul>
    </div>




    <main>
      <section>



        <h1 style=" text-align:center"> Formulaire de recherche d'emploi</h1>

        <form name="selection" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
          <label for="dep">Choisissez votre bassin d'emploi</label>
          <select name="dep" id="dep" style=" max-width:200px">
            <option value="">Choisir un Département</option>
            <?php
            include("models/connection.php");

            $connect = maConnection::getInstance();

            $requete = "SELECT id_dep,name from departements where dep_actif=1";
            $state = $connect->prepare($requete);
            $state->execute();
            while ($obj = $state->fetch()) {
              if (isset($_POST["dep"]) && !empty($_POST["dep"]) && $_POST["dep"] == $obj->id_dep) {

                echo '<option value="' . $obj->id_dep . '" selected="selected" >' . $obj->name . '</option>';
              } else {
                echo '<option value="' . $obj->id_dep . '" >' . $obj->name . '</option>';
              }
            }

            ?>

          </select>
          <br>
          <hr><br>
          <fieldset>
            <legend> Sélectionner votre type d\'établissement</legend>
            <div>
              <input type="checkbox" name="choix[]" value="TPE" id="tpe"  <?php  
            
                if (isset($_POST["choix"])) {
              
               
                foreach ($_POST["choix"] as $key => $value) { 
                  if ($value=="TPE")
                   { echo "checked='true'";
              
                }
           
              }
            } ?> />
              <label for="tpe">TPE </label>
            </div>
            <div>
              <input type="checkbox" name="choix[]" value="PME" id="pme" <?php  
            
            if (isset($_POST["choix"])) {
          
           
            foreach ($_POST["choix"] as $key => $value) { 
              if ($value=="PME")
               { echo "checked='true'";
          
            }
       
          }
        } ?> />
              <label for="pme">PME</label>
            </div>
            <div>
              <input type="checkbox" name="choix[]" value="GE" id="ge" 
              
              <?php  
            
            if (isset($_POST["choix"])) {
          
           
            foreach ($_POST["choix"] as $key => $value) { 
              if ($value=="GE")
               { echo "checked='true'";
          
            }
       
          }
        } ?>
              />
              <label for="ge">GRANDE ENTREPRISE</label>
            </div>
            <div>
              <input type="checkbox" name="choix[]" value="CT" id="ct" 
               
              <?php  
            
            if (isset($_POST["choix"])) {
          
           
            foreach ($_POST["choix"] as $key => $value) { 
              if ($value=="CT")
               { echo "checked='true'";
          
            }
       
          }
        } ?>
              
              />
              <label for="ct"> COLLECTIVITE TERRITORIALE</label>
            </div>
            <div>
              <input type="checkbox" name="choix[]" value="ASSOC" id="assoc"
              
              <?php  
            
            if (isset($_POST["choix"])) {
          
           
            foreach ($_POST["choix"] as $key => $value) { 
              if ($value=="ASSOC")
               { echo "checked='true'";
          
            }
       
          }
        } ?>

              />
              <label for="assoc">ASSOCIATION</label>
            </div>
            <div>
              <input type="checkbox" name="choix[]" value="AUTRES" id="autre"
              
              <?php  
            
            if (isset($_POST["choix"])) {
          
           
            foreach ($_POST["choix"] as $key => $value) { 
              if ($value=="AUTRES")
               { echo "checked='true'";
          
            }
       
          }
        } ?>

              
              />
              <label for="autre">AUTRES (secteur public)</label>
            </div>
          </fieldset>
          <div>
            <input type="submit" value="Valider" name="validation" style="margin-left:400px;" />
            <input type="button" onclick="javascript: window.print()" value="imprimer" />
          </div>
        </form>
      </section>
    </main>
    <?php

    $connect = maConnection::getInstance();
    if (isset($_POST["validation"]) && !empty($_POST["dep"])) {

      $dep = $_POST["dep"];
     
      if (!empty($_POST['choix'])) { 
        $meschoix = "";
        //On fait une opération de contruction d'une chaine (chainage) des différentes valeurs contenues dans le tableau indicé $_POST["choix"];   
        for ($i = 0; $i < count($_POST["choix"]); $i++) 
            {
              $meschoix .= ",'" . $_POST["choix"][$i] ."'";
            }
        // On supprime la virgule se trouvant en première position dans la chaine avec substr(), elle est de trop    
        $listechoix = substr($meschoix, 1);
       
        $finrq = ' AND type_etab IN (' . $listechoix. ')';
      } else {
        $finrq = '';
      }
      // $finrq va définir la fin de la requête préparée au cas où on a utilisé des cases à cocher, cette chaine est vide si rien n'est coché.   


      $rq = "Select  nom_etab, type_etab, nom_resp, adresse, cp, ville, Telephone, email from institutions where depart=:departement".$finrq;
      $state = $connect->prepare($rq);
      $state->execute(array(":departement" => $_POST["dep"]));


      echo '<caption align="center">Résultats de  votre recherche</caption><table class="table table-striped" >';
      echo '<thead>
          <thead>
          <tr><th>Nom Etab</th><th>Type Etab</th><th>Nom Resp</th><th>Adresse</th><th>Code Postal</th><th>ville</th><th>Telephone</th><th>Email</th>
          </tr>
          </thead><tbody>';

      while ($monObj = $state->fetch()) {
        echo '<tr>';
        foreach ($monObj as $key => $value) {


          echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
      }

      echo '<tbody></table>';
    }


    ?>
    <aside>
      complément
    </aside>
    </section>
    </main>



    <footer>
      Copyright
    </footer>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>