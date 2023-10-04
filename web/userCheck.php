<?php
session_start();

    require_once dirname(__DIR__).'/config/connexion.php';
    require_once dirname(__DIR__).'/service/verif.php';
    require_once dirname(__DIR__).'/repository/user.php';

    $db = connect($config);
    echo 'Test';
    if ($db == null) {
    } else {
        if (isset($_POST['btConnexion'])) {
            if (isset($_POST['inputPseudo'])
                && isset($_POST['inputPassword'])
                && isset($_POST['token'])
                && isset($_POST['sendDate'])) {
                    $post = $_POST['inputPseudo'];
                    $password = $_POST['inputPassword'];
                    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
                    $senDate =$_POST['sendDate'];
                    echo 'On a tous les champs';

                    if (!$token) {
                        echo 'Il manque un token';
                        exit;
                    } else {
                        echo 'Il y a un token';
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
                                            $_SESSION['isLogged'] = true;
                                            $_SESSION['target'] = 'listContent.php';
                                            unset($_SESSION['backspace']);
                                            header("Location: ".dirname(__DIR__)."/index.php");
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
        } else {
            $_SESSION['authError'] = 'Vous n\'avez pas de formulaire';
        }
        $_SESSION['target'] = '';
        header("Location: ../");
    }