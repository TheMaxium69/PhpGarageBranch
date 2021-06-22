<?php   
  require_once "core/database.php";
  require_once "core/utils.php";

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
      $annonce_id = $_GET['id'];
}
if(!$annonce_id){
  die("il faut entrer un id valide en paramtre dans l'url");
}


$annonce = findAnnonceById($annonce_id);



if(!$annonce){
    die("cette annonce est inexistante");
}


deleteAnnonce($annonce_id);

redirect('garage.php?id='.$annonce['garage_id']);