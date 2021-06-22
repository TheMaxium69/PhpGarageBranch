<?php


function getPdo(){

    $pdo = new PDO('mysql:host=localhost;dbname=garages','garage' ,'garage', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  ,
        PDO::ATTR_DEFAULT_FETCH_MODE  =>    PDO::FETCH_ASSOC          
      ]);

      return $pdo;

}
/**
 * retourne un tableau contenant tous les garages de 
 * la table garages
 * 
 * @return array
 */
function findAllGarages() : array
{
        $pdo = getPdo();

        $resultat =  $pdo->query('SELECT * FROM garages');
        
        $garages = $resultat->fetchAll();

        return $garages;

}

/**
 * trouver un garage par son id
 * renvoie un tableau contenant un garage, ou un booleen
 * si inexistant
 * 
 * @param integer $garage_id
 * @return array|bool
 */
function findGarageById(int $garage_id)
{

  $pdo = getPdo();

  $maRequete = $pdo->prepare("SELECT * FROM garages WHERE id =:garage_id");

  $maRequete->execute(['garage_id' => $garage_id]);

  $garage = $maRequete->fetch();

  return $garage;

}


/**
 * trouve toutes les annonces liées à un garage
 * par ce meme garage
 * 
 * @param integer $garage_id
 * @return array|bool
 * 
 */

function findAllAnnoncesByGarage(int $garage_id)
{

  $pdo = getPdo();

  $resultat =  $pdo->prepare('SELECT * FROM annonces WHERE garage_id = :garage_id');
  $resultat->execute(["garage_id"=> $garage_id]);
   
  $annonces = $resultat->fetchAll();
  return $annonces;
}


/**
 * trouve une annonce par son id
 * 
 * @param integer $annonce_id
 * @return array|bool
 */
function findAnnonceById(int $annonce_id) 
{
  $pdo = getPdo();

$maRequete = $pdo->prepare("SELECT * FROM annonces WHERE id =:annonce_id");

$maRequete->execute(['annonce_id' => $annonce_id]);

$annonce = $maRequete->fetch();

return $annonce;


}
/**
 * supprime une annonce via son ID
 * 
 * @param integer $annonce_id
 * @return void
 */

function deleteAnnonce(int $annonce_id) : void
{

  $pdo = getPdo();
  $garage_id = $annonce['garage_id'];


  $maRequete = $pdo->prepare("DELETE FROM annonces WHERE id =:annonce_id");
  
  $maRequete->execute(['annonce_id' => $annonce_id]);
  
}

/**
 * supprime un garage via son ID
 * @param integer $garage_id
 * @return void
 */
function deleteGarage(int $garage_id) :void
{
  $pdo = getPdo();

  $maRequete = $pdo->prepare("DELETE FROM garages WHERE id =:garage_id");

  $maRequete->execute(['garage_id' => $garage_id]);


}

/**
 * ajoute une annonce
 * 
 * @param string $name
 * @param int $price
 * @param int $garage_id
 * @return void
 */

function insertAnnonce(string $name, int $price, int $garage_id) : void
{
  $pdo = getPdo();
  $maRequeteSaveAnnonce = $pdo->prepare("INSERT INTO annonces (name, price, garage_id) 
  VALUES (:name, :price, :garage_id)");

    $maRequeteSaveAnnonce->execute([
    'name' => $name,
    'price' => $price,
    'garage_id' => $garage_id

    ]);
}