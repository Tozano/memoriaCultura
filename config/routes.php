<?php
    
function getPage(){

    $lesPages['accueil'] = "accueilControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['inscription'] = "inscrireControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['profil'] = "profilControleur";
    $lesPages['mycontent'] = "showMyContentControleur";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }  else{
        $page = 'accueil';
    }

    if (!isset($_SESSION['login']) && $page == 'profil') {
        $page = 'accueil';
    }

    if (!isset($lesPages[$page])){
        $page = 'accueil';
    } 
    $contenu = $lesPages[$page];
    return $contenu;

}
?>