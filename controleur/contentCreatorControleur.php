<?php
    function showMyContentControleur($db){
        $user = new User($db);
        $userData = $user->selectUserByPseudo($_SESSION['login']);
        $content = new Content($db);
        $contentsData = $content->selectAllContentsByCreator($userData['user_id']);
        require_once "template/contentCreator/ownListContent.php";
    }

    function addContentControleur($db){
        require_once "template/contentCreator/addContent.php";
    }

    function removeContentControleur($db){
    }