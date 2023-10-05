<?php
    function profilControleur($db){
        if (isset($_POST['btUserModify'])) {
            if ($db == null) {
                $_SESSION['authError'] = 'Connexion impossible';
            } else {
                if (isset($_POST['inputEmail'])
                    && isset($_POST['inputNom'])
                    && isset($_POST['token'])
                    && isset($_POST['sendDate'])
                    && isset($_POST['inputShortDesc'])
                    && isset($_POST['inputLongDesc'])) {
                        $email = $_POST['inputEmail'];
                        $nom = $_POST['inputNom'];
                        $prenom = $_POST['inputPrenom'];
                        $shortDesc = $_POST['inputShortDesc'];
                        $longDesc = $_POST['inputLongDesc'];
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
                                        //if (true) {
                                            $pseudo = $_SESSION['login'];
                                            $userToModify = new User($db);
                                            
                                            $r = $userToModify->updateUser($pseudo, $email, $nom, $prenom, $shortDesc, $longDesc);
                                            if ($r) {
                                                $_SESSION['authNotify'] = 'Vous avez bien été modifié '.$pseudo;
                                            } else {
                                                $_SESSION['authError'] = 'Vous n\'avez pas pu être modifié';
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
        $user = new User($db);
        $userData = $user->selectUserByPseudo($_SESSION['login']);
        require_once "template/authentifiedUser/profil.php";
    }