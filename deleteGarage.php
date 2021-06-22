<?php
     require_once "core/database.php";
    require_once "core/utils.php";


    if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

        $garage_id = $_GET['id'];
  
  }
     if(!$garage_id){

        die("il faut entrer un id valide en paramtre dans l'url");
     }




        $pdo = getPdo();




// on veut verifier que cet garage existe bien dans la base de données



$garage = findGarageById($garage_id);
//si le garage n'existe pas
if(!$garage){
    die("ce garage est inexistant");
}

// alors , faire la requete de suppression


$maRequete = $pdo->prepare("DELETE FROM garages WHERE id =:garage_id");

$maRequete->execute(['garage_id' => $garage_id]);




redirect('index.php');