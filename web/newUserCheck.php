<?php
session_start();

    require_once 'config/connexion.php';
    require_once 'service/verif.php';
    require_once 'repository/user.php';

    $db = connect($config);
    if ($db == null) {
        echo "Revenez plus tard";
    } else {
        if (isset($_POST['btInscrire'])) {
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
                                    if (verif($pseudo, $email, $password, $passwordConf, $nom, $prenom, $shortDesc)) {
                                        $password = password_hash($password, PASSWORD_DEFAULT);
                                        $r = insertUtilisateur($db, $email, $password, $nom, $prenom, $shortDesc);
                                        if ($r) {
                                            echo 'Vous êtes bien enregistré '.$email;
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
        } else {
            $_SESSION['authError'] = 'Vous n\'avez pas de formulaire';
        }
    }