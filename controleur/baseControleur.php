<?php
    function accueilControleur($db){
        $content = new Content($db);
        $contentsData = $content->selectAllContent();
        require_once "template/mainpage.php";
    }
?>