<?php
    if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

        $annonce_id = $_GET['id'];
  
  }
     if(!$annonce_id){

        die("il faut entrer un id valide en paramtre dans l'url");
     }

     echo"salut c'est bon";


     $pdo = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  ,
        PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
        ]);

        


$maRequete = $pdo->prepare("SELECT * FROM annonces WHERE id =:annonce_id");

$maRequete->execute(['annonce_id' => $annonce_id]);

$annonce = $maRequete->fetch();
//si le annonce n'existe pas
if(!$annonce){
    die("cette annonce est inexistante");
}


$garage_id = $annonce['garage_id'];


$maRequete = $pdo->prepare("DELETE FROM annonces WHERE id =:annonce_id");

$maRequete->execute(['annonce_id' => $annonce_id]);

//faire un header vers index.php  (une redirection)

header("Location: garage.php?id=$garage_id");
