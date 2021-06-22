<?php

require_once "core/database.php";
require_once "core/utils.php";

$garage_id = null;

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

      $garage_id = $_GET['id'];
}
  
if(!$garage_id){
    die("il faut absolument entrer un id dans l'url pour que le script fonctionne");
}


  $garage = findGarageById($garage_id);

  $annonces = findAllAnnoncesByGarage($garage_id);

  $titreDeLaPage = $garage['name'];

 render('garages/garage',
        compact('garage', 'annonces','titreDeLaPage')       
);