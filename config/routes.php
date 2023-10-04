<?php
    
function getPage(){

    $lesPages['accueil'] = "accueilControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['inscription'] = "inscrireControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }  else{
        $page = 'accueil';
    }

    if (!isset($lesPages[$page])){
        $page = 'accueil';
    } 
    $contenu = $lesPages[$page];
    return $contenu;

}
?>