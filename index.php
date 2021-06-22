<?php 



// moteur : mysql  host : localhost db : garages   user: garage  mdp:garage il y a une 'garages' : name, adresse, description

// Documentation de PDO sur PHP.net

// etablir la connection avec la db

//préparer la requete avec pdo

// executer la requete avec des options : on veut obtenir un tableau associatif

//stocker le resultat de la requete dans la variable $garages
// PHP Data Object
$pdo = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
   PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
 ]);

//query

 $resultat =  $pdo->query('SELECT * FROM garages');
   
$garages = $resultat->fetchAll();

$titreDeLaPage = "Garages";

//buffer
// j'active la mémoire tampon
//les instruction suivantes ne seront pas affichées dans la page HTML finale
ob_start();


require_once "templates/garages/garages.html.php";
//et ce jusqu'à ce qu'on désactive la memoire tampon
//au passage, on récupère son contenu (et donc garages.html.php) pour 
//le stocker dans la variable $contenuDeLaPage



$contenuDeLaPage = ob_get_clean();


require_once "templates/layout.html.php";
