<?php

$garage_id = null;
$name = null;
$price = null;

if(!empty($_POST['garageId']) && ctype_digit($_POST['garageId']) ){
    $garage_id = $_POST['garageId'];
}

if(!empty($_POST['name']) ){
    $name = htmlspecialchars($_POST['name']);
}

if(!empty($_POST['price']) ){
    $price = htmlspecialchars($_POST['price']);
}



if( !$garage_id || !$name || !$price ){
    die("formulaire mal rempli");
}


$pdo = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  ,
    PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
  ]);


  $maRequete = $pdo->prepare("SELECT * FROM garages WHERE id =:garage_id");

  $maRequete->execute(['garage_id' => $garage_id]);

  $garage = $maRequete->fetch();

  if(!$garage){

    die("garage inexistant");
  }

  $maRequeteSaveAnnonce = $pdo->prepare("INSERT INTO annonces (name, price, garage_id) 
                                        VALUES (:name, :price, :garage_id)");

  $maRequeteSaveAnnonce->execute([
                                    'name' => $name,
                                    'price' => $price,
                                    'garage_id' => $garage_id

                        ]);


header("Location: garage.php?id=$garage_id");



/// Surveiller POST

// Verifier les trois données transmises par POST


/// faire une requete pour verifier 
//l'existance du garage
//si le garage est inexistant, 
//die("garage inexistant")

//autrement


//insérer la nouvelle annonce

//redirection vers la page du garage