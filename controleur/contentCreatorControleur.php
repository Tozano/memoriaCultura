<?php
    function showMyContentControleur($db){
        $user = new User($db);
        $userData = $user->selectUserByPseudo($_SESSION['login']);
        $content = new Content($db);
        $contentsData = $content->selectAllContentsByCreator($userData['user_id']);
        require_once "template/contentCreator/ownListContent.php";
    }

    function addContentControleur($db){
        if ($_SESSION['role'] == 1) {
            if (isset($_POST['btAddContent'])) {
                if ($db == null) {
                    $_SESSION['authError'] = 'Connexion impossible';
                } else {
                    if (isset($_POST['inputTitle'])
                        && isset($_POST['inputDesc'])
                        && isset($_POST['inputAddress'])
                        && isset($_POST['inputYear'])
                        && isset($_POST['token'])
                        && isset($_POST['sendDate'])) {
                            $title = $_POST['inputTitle'];
                            $desc = $_POST['inputDesc'];
                            $address = $_POST['inputAddress'];
                            $year = $_POST['inputYear'];
                            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
                            $senDate =$_POST['sendDate'];
                            
                            if (!$token) {
                                echo 'Il manque un token';
                                exit;
                            } else {
                                foreach ($_SESSION['tokens'] as $aToken) {
                                    if ($aToken[0] == $senDate) {
                                        if ($token !== $aToken[1]) {
                                            echo 'Le token n\'est pas le bon :';
                                        } else {
                                            //if (verifInsertUser($pseudo, $email, $password, $passwordConf, $nom, $prenom, $shortDesc)) {
                                                $user = new User($db);
                                                $userData = $user->selectUserByPseudo($_SESSION['login']);
                                                $content = new Content($db);
                                                $r = $content->insertContent($title, $desc, $address, $year, $userData['user_id']);
                                                
                                                if ($r) {
                                                    echo 'Vous êtes bien ajouté '.$title;
                                                    header("Location: index.php?page=mycontent");
                                                } else {
                                                    $_SESSION['authError'] = 'Vous n\'avez pas pu ajouter du contenu';
                                                }
                                            //}
                                        }
                                    }
                                    if ($aToken[0] >= date("Y-m-d H:i:s")) {
                                        unset($aToken);
                                    }
                                }
                            }    
                    } else {
                        $_SESSION['authError'] = 'Il manque une variable dans le formulaire';
                    }
                }
            }
        } else {
            $_SESSION['authError'] = 'Vous n\'avez pas les droits';
        }
        require_once "template/contentCreator/addContent.php";
    }

    function removeContentControleur($db){
        if ($_SESSION['role'] == 1) {
            $contentId = $_GET['contentId'];
            $user = new User($db);
            $userData = $user->selectUserByPseudo($_SESSION['login']);
            $content = new Content($db);
            $contentData = $content->selectContentById($contentId);
            if ($contentData['user_id'] == $userData['user_id']) {
                $content->deleteContentById($contentId);
            } else {
                $_SESSION['authError'] = 'Vous n\'avez pas les droits';
            }
        } else {
            $_SESSION['authError'] = 'Vous n\'avez pas les droits';
        }
        header("Location: index.php?page=mycontent");
    }