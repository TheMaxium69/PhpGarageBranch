<?php


/**
 * 
 * redirige vers l'url passé en parametre
 * @param string $url
 */

function redirect(string $url) : void 

{

    header('Location: '.$url);
    
}

/**
 * 
 * genere le rendu de données interpolées dans un template
 * 
 * @param string $template
 * @param array $donnees
 * 
 */
function render(string $template, array $donnees):void
{


    extract($donnees);
   
    ob_start();


    require_once "templates/".$template.".html.php";
 
    
    $contenuDeLaPage = ob_get_clean();
    
    
    require_once "templates/layout.html.php";

}