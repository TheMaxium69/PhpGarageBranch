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
 * 
 * 
 * 
 */
function findGarageById(int $garage_id) : array
{

  $pdo = getPdo();

  $maRequete = $pdo->prepare("SELECT * FROM garages WHERE id =:garage_id");

  $maRequete->execute(['garage_id' => $garage_id]);

  $garage = $maRequete->fetch();

  return $garage;

}