<?php
    function inscrireControleur($db){
        if (isset($_POST['btInscrire'])) {
            if ($db == null) {
                $_SESSION['authError'] = 'Connexion impossible';
            } else {
                if (isset($_POST['inputPseudo'])
                    && isset($_POST['inputEmail'])
                    && isset($_POST['inputPassword'])
                    && isset($_POST['inputPasswordConf'])
                    && isset($_POST['inputNom'])
                    && isset($_POST['token'])
                    && isset($_POST['sendDate'])
                    && isset($_POST['inputShortDesc'])) {
                        $post = $_POST['inputPseudo'];
                        $email = $_POST['inputEmail'];
                        $password = $_POST['inputPassword'];
                        $passwordConf = $_POST['inputPasswordConf'];
                        $nom = $_POST['inputNom'];
                        $prenom = $_POST['inputPrenom'];
                        $shortDesc = $_POST['inputShortDesc'];
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
                                        if (verifInsertUser($pseudo, $email, $password, $passwordConf, $nom, $prenom, $shortDesc)) {
                                            $password = password_hash($password, PASSWORD_DEFAULT);
                                            $r = insertUser($db, $email, $password, $nom, $prenom, $shortDesc);
                                            if ($r) {
                                                echo 'Vous êtes bien enregistré '.$pseudo;
                                                $_SESSION['isLogged'] = true;
                                                $_SESSION['target'] = 'listContent.php';
                                                unset($_SESSION['backspace']);
                                                header("Location: index.php");
                                            } else {
                                                $_SESSION['authError'] = 'Vous n\'avez pas pu être enregistré';
                                                $_SESSION['target'] = 'inscription.php';
                                                header("Location: inscription.php");
                                            }
                                        }
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
        require_once "template/inscription.php";
    }

    function connexionControleur($db){ 
            if (isset($_POST['btConnexion'])) {
                if ($db == null) {
                    $_SESSION['authError'] = 'Connexion impossible';
                } else {
                    if (isset($_POST['inputPseudo'])
                        && isset($_POST['inputPassword'])
                        && isset($_POST['token'])
                        && isset($_POST['sendDate'])) {
                            $post = $_POST['inputPseudo'];
                            $password = $_POST['inputPassword'];
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
                                            if (verifUserForConnexion($pseudo, $password)) {
                                                $password = password_hash($password, PASSWORD_DEFAULT);
                                                $r = selectUserByPseudo($db, $pseudo);
        
                                                if ($aToken[0] >= date("Y-m-d H:i:s")) {
                                                    unset($aToken);
                                                }
                                                if ($r) {
                                                    echo 'Connexion à '.$pseudo;
                                                } else {
                                                    $_SESSION['authError'] = 'Vous n\'avez pas pu être connecté';
                                                }
                                            }
                                        }
                                    }
                                }
                            }    
                    } else {
                        $_SESSION['authError'] = 'Il manque une variable dans le formulaire';
                    }
                }
            }
        require_once "template/register.php";
    }

    function deconnexionControleur(){
        session_unset();
        session_destroy();
        header("Location:index.php");
    }
?>