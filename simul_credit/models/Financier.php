
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


}  




?>