<?php

session_start();

require_once 'config/connexion.php';
require_once 'controleur/_controleurs.php';
require_once 'config/routes.php';

$db = connect($config);   
    
$contenu = getPage();
$contenu($db);