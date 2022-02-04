
<?php

class Financier 
{
 public $capital;
 public $tauxMensuel;
 public $nbMois;
 
 //constructeur avec surcharges (paramêtres)
 
 public function __construct( $_capital,$_tauxannuel,$_ans )
 {
     $this->capital=$_capital;
     $this->tauxMensuel=(double)$_tauxannuel/(100*12);
     $this->nbMois=$_ans*12;
}


// methodes d'instance calcul de la mensualité constante. 

public function calculMensualite() 
{

    $quotient=(1-pow((1+$this->tauxMensuel),-$this->nbMois));

    $mensualite=($this->capital*$this->tauxMensuel)/$quotient;
//
    return round($mensualite,2,PHP_ROUND_HALF_UP);


}

public function tableauAmortissement()
{

echo "<table><thead><tr><td>Nombre de mois</td><td>Part intérêt</td><td>Part amortissement</td><td>Capital restant dû</td><td>Mensualité</td></tr></thead><tbody>";
$numMois=1;
$capitalRestant=0;
$partInteret=0;
$partAmrt=0;
$mensualite=$this->calculMensualite();

do {
   

    if ($numMois==1) 
    {
        $capitalRestant=$this->capital;
    }
    else 
    {
         $capitalRestant=$capitalRestant-$partAmrt;
    }
    $partInteret=$capitalRestant*$this->tauxMensuel;
    $partAmrt=  $mensualite - $partInteret;  



echo "<tr>";
echo "<td>".$numMois."</td><td>".round($partInteret,2)."</td><td>".round($partAmrt,2)."</td><td>".round($capitalRestant,2)."</td><td>".$mensualite."</td>";

echo "</tr>";
$numMois++;
} while ($numMois <= $this->nbMois);

echo "</tbody></table>";

}


}  




?>

