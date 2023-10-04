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
                        $pseudo = $_POST['inputPseudo'];
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
                                            $user = new User($db);
                                            
                                            $r = $user->insertUser($pseudo, $email, $password, $nom, $prenom, $shortDesc);
                                            if ($r) {
                                                echo 'Vous êtes bien enregistré '.$pseudo;
                                                
                                                $_SESSION['login'] = $pseudo;
                                                $_SESSION['role'] = 0;
                                                header("Location: index.php");
                                            } else {
                                                $_SESSION['authError'] = 'Vous n\'avez pas pu être enregistré';
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
            if (isset($_POST['btRegister'])) {
                if ($db == null) {
                    $_SESSION['authError'] = 'Connexion impossible';
                } else {
                    if (isset($_POST['inputPseudo'])
                        && isset($_POST['inputPassword'])
                        && isset($_POST['token'])
                        && isset($_POST['sendDate'])) {
                            $pseudo = $_POST['inputPseudo'];
                            $password = $_POST['inputPassword'];
                            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
                            $senDate =$_POST['sendDate'];
                            if (!$token) {
                                $_SESSION['authError'] = 'Il manque un token';
                                exit;
                            } else {
                                foreach ($_SESSION['tokens'] as $aToken) {
                                    if ($aToken[0] == $senDate) {
                                        if ($token !== $aToken[1]) {
                                            $_SESSION['authError'] = 'Le token n\'est pas le bon :';
                                        } else {
                                            if (verifUserForConnexion($pseudo, $password)) {
                                                $user = new User($db);

                                                $r = $user->selectUserByPseudo($pseudo);

                                                if ($aToken[0] >= date("Y-m-d H:i:s")) {
                                                    unset($aToken);
                                                }
                                                if ($r) { 
                                                    if (password_verify($password, $r['mdp'])) {
                                                        $_SESSION['authNotify'] = 'Connexion à '.$pseudo;
                                                        $_SESSION['login'] = $pseudo;
                                                        $_SESSION['role'] = $r['user_role'];
                                                        header("Location: index.php");
                                                    } else {
                                                        $_SESSION['authError'] = 'Login/mot de passe incorrect';
                                                    }
                                                } else {
                                                    $_SESSION['authError'] = 'Login/mot de passe incorrect';
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