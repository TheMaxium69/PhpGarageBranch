<?php

//effacer un garage

// on est basé sur GET    =>   monsite/deleteGarage.php?id=3




//on va verifier ce que l'on trouve dans GET
    //on veut qu'il ne soit pas vide
    //on veut que ca soit un nombre

    if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

        $garage_id = $_GET['id'];
  
  }
     if(!$garage_id){

        die("il faut entrer un id valide en paramtre dans l'url");
     }




//on génère notre PDO   -> notre connection à la base de données
        // avec les bons parametres (erreur, tableau associatif)


$pdo = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  ,
    PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
    ]);





// on veut verifier que cet garage existe bien dans la base de données



$maRequete = $pdo->prepare("SELECT * FROM garages WHERE id =:garage_id");

$maRequete->execute(['garage_id' => $garage_id]);

$garage = $maRequete->fetch();
//si le garage n'existe pas
if(!$garage){
    die("ce garage est inexistant");
}

// alors , faire la requete de suppression


$maRequete = $pdo->prepare("DELETE FROM garages WHERE id =:garage_id");

$maRequete->execute(['garage_id' => $garage_id]);

//faire un header vers index.php  (une redirection)

header("Location: index.php");