<?php

spl_autoload_register(function($class) {include  "models/".$class.".php";} );

$monObj=new Financier(5000,1.5,3);
$mensualite=$monObj->calculMensualite();
echo "la mensualité constante du prêt est :".$mensualite;
?>