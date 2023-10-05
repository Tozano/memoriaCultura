<?php
    function accueilControleur($db){
        require_once "template/mainpage.php";
    }

    function listContentControleur($db){
        $year = $_GET['year'];
        $content = new Content($db);
        $contentsData = $content->selectAllContentByYear($year);
        require_once "template/listContent.php";
    }
?>