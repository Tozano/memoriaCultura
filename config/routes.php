<?php
    
function getPage(){

    $lesPages['accueil'] = "accueilControleur";
    $lesPages['contents'] = "listContentControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['inscription'] = "inscrireControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['profil'] = "profilControleur";
    $lesPages['mycontent'] = "showMyContentControleur";
    $lesPages['addcontent'] = "addContentControleur";
    $lesPages['removecontent'] = "removeContentControleur";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }  else{
        $page = 'accueil';
    }

    if (!isset($_SESSION['login']) && ($page == 'profil' || $page == 'mycontent' || $page == 'addcontent' || $page == 'removecontent')) {
        $page = 'accueil';
    }

    if (!isset($_SESSION['role'])) {
        if ($_SESSION['role'] != 1 && ($page == 'mycontent' || $page == 'addcontent' || $page == 'removecontent')) {
            $page = 'accueil';
        }
    }
    if (!isset($lesPages[$page])){
        $page = 'accueil';
    } 
    $contenu = $lesPages[$page];
    return $contenu;
}
?>