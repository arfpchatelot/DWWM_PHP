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
        $chaine.="<tr>";
        for ($i=0; $i <count($tabnoms) ; $i++) 
        {
        
            $chaine.="<th>".strtoupper($tabnoms[$i])."</th>" ;
            
        }    
        $chaine.="</tr>";
        while ($row = $this->statement->fetch()) {
            $chaine .= "<tr>";

            for ($i = 0; $i < count($row); $i++) {
                $chaine .= "<td>" . $row[$i] . "</td>";
            }

            $chaine .= "</tr>";
        }
        $chaine .= "</table>";
        return $chaine;
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






}
