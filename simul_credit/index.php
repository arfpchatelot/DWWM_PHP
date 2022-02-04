<?php

spl_autoload_register(function($class) {include  "models/".$class.".php";} );

$monObj=new Financier(110000,1.2,15);
$mensualite=$monObj->calculMensualite();
echo "la mensualité constante du prêt est :".$mensualite;

$monObj->tableauAmortissement();

?>