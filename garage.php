<?php


$garage_id = null;

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

      $garage_id = $_GET['id'];

}
   
if(!$garage_id){

    die("il faut absolument entrer un id dans l'url pour que le script fonctionne");
}


$pdo = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  ,
    PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
  ]);


  $maRequete = $pdo->prepare("SELECT * FROM garages WHERE id =:garage_id");

  $maRequete->execute(['garage_id' => $garage_id]);

  $garage = $maRequete->fetch();


  $resultat =  $pdo->prepare('SELECT * FROM annonces WHERE garage_id = :garage_id');
  $resultat->execute(["garage_id"=> $garage_id]);
   
  $annonces = $resultat->fetchAll();
  




                            
                            
                            



  $titreDeLaPage = $garage['name'];

    ob_start();

    require_once "templates/garages/garage.html.php";



  $contenuDeLaPage = ob_get_clean();

  require_once "templates/layout.html.php";



  //   echo $garage['description'];
// développer le template garage.html.php
//à partir de $garage insérer le tout dans layout.html.php