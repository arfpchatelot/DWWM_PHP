<?php

spl_autoload_register(function($class) {include  "models/".$class.".php";} );

$monObj=new Financier(110000,1.2,15);
$mensualite=$monObj->calculMensualite();
echo "la mensualité constante du prêt est :".$mensualite;

//$monObj->tableauAmortissement();

    $mesdata=$monObj->getTableau();
$json=json_encode($mesdata,JSON_PRETTY_PRINT);
    file_put_contents("financier.json", $json);

?>