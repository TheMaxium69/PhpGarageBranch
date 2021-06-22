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




$pdo = getPdo();


  

  $garage = findGarageById($garage_id);

  


  $resultat =  $pdo->prepare('SELECT * FROM annonces WHERE garage_id = :garage_id');
  $resultat->execute(["garage_id"=> $garage_id]);
   
  $annonces = $resultat->fetchAll();
  



  $titreDeLaPage = $garage['name'];

 render('garages/garage',
        compact('garage', 'annonces','titreDeLaPage')       
);