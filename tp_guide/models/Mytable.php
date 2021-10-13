<?php

class Mytable
{
    //attributs
    public $connexion;
    private $table;
    private $statement;
    private $nbcol;

    // propriétés

    //constructeur
    public function __construct(string $_table)
    {


        $this->connexion=self::creerConnexion();
        $this->table = $_table;
        $sql = "SELECT * FROM " . $this->table;
        $this->statement = $this->connexion->prepare($sql);
        $this->statement->execute();
    }


    //methode 
    public static function creerConnexion()
    {
       
        try {
            $connexion = new PDO(
                'mysql:host=localhost;dbname=guide',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_CASE => PDO::CASE_LOWER,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );

            
        } catch (PDOException $e) {

            die("Database connection failed: " . $e->getMessage());
					
            return "erreur connexion";
        }

        return $connexion;
    }


    public function afficherTable()
    {
        $chaine = "<table class='table table-dark table-hover' >";
        $tabnoms=$this->recupTableauColumns();
        $chaine.="<tr><th>modifier</th><th>supprimer</th>";
        for ($i=0; $i <count($tabnoms) ; $i++) 
        {
        
            $chaine.="<th>".strtoupper($tabnoms[$i])."</th>" ;
            
        }    
        $chaine.="</tr>";
        while ($row = $this->statement->fetch()) {
            $chaine .= "<tr><td><form action='affichedetail.php' method='POST' enc-type='text/plain'>
            <input type='submit' value='modifier' name='".$row[0]."' id='".$row[0]."' ><input type='hidden' value='".$row[0]."' name='modif' ></form></td>
            <td><a href='#'>supprimer</a></td>";

            for ($i = 0; $i < count($row); $i++) {
                $chaine .= "<td>" . $row[$i] . "</td>";
            }

            $chaine .= "</tr>";
        }
        $chaine .= "</table>";
        return $chaine;
    }
   
    public function afficherligne($_id)
    {
        $requete="SELECT * FROM ".$this->table." WHERE id=:id";
          $state=$this->connexion->prepare($requete);
         $state->bindParam(":id",$_id,PDO::PARAM_INT);
         $state->execute();
         return $state->fetch();   


    }


private function recupTableauColumns()
{
 $nomcols=[];
 for ($i=0 ; $i < $this->statement->columnCount() ; $i++) 
 {
     
 $res =$this->statement->getColumnMeta($i);
//echo $res["flags"][1]."<br>";
 //var_dump($res["flags"]);
  if(count($res["flags"])>1 && $res["flags"][1]=="primary_key" )
  {
    array_push($nomcols,$res["name"]." clé primaire");
         

  }else
{ array_push($nomcols,$res["name"]); }
 
 
     # code...
 }
return $nomcols;
}

public function modifierOccurence($_id, array $_table )
{
        $sql="UPDATE ".$this->table." set  nom=:nom , adresse=:adresse, prix=:prix , commentaire=:commentaire , note=:note, date_visite=:date where id=".$_id;
   $statement= $this->connexion->prepare($sql);
    $statement->bindParam(":nom",$_table[0],PDO::PARAM_STR );
    $statement->bindParam(":adresse",$_table[1],PDO::PARAM_STR );
    $statement->bindParam(":prix",$_table[2],PDO::PARAM_STR );
    $statement->bindParam(":commentaire",$_table[3],PDO::PARAM_STR );
    $statement->bindParam(":note",$_table[4],PDO::PARAM_STR );
    $statement->bindParam(":date",$_table[5],PDO::PARAM_STR );

    $statement->execute();
    $nbligne=$statement->rowCount();
    if ($nbligne==1) {

    return "Modifications prises en compte";
    }
    else
    {
          return "Erreur! modification non prise en compte";  
    }

} 






}
