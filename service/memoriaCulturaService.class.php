<?php
session_start();

require_once dirname(__DIR__).'/repository/UserRepository.php';

require_once dirname(__DIR__).'/service/verif.php';

class MemoriaCulturaService {
    protected $userRepo;

    function __construct() {
        $this->userRepo = new UserRepository();
    }

    function userCheck() {

            if (isset($_POST['btRegister'])) {
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
                                            $r = $this->userRepo->selectUserByPseudo($pseudo);

                                            if ($aToken[0] >= date("Y-m-d H:i:s")) {
                                                unset($aToken);
                                            }

                                            if ($r) {
                                                echo 'Connexion à '.$pseudo;
                                                $_SESSION['isLogged'] = true;
                                                $_SESSION['target'] = 'listContent.php';
                                                $_SESSION['backspace'] = [];
                                                header("Location: ../");
                                            } else {
                                                $_SESSION['authError'] = $message;
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
    }

    function newUserCheck() {

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
                                        if (verifInsertUser($pseudo, $email, $password, $passwordConf, $nom, $prenom, $shortDesc)) {
                                            $password = password_hash($password, PASSWORD_DEFAULT);
                                            $r = $this->insertUser($pseudo, $email, $password, $nom, $prenom, $shortDesc);
                                            if ($r) {
                                                echo 'Vous êtes bien enregistré '.$pseudo;
                                                $_SESSION['isLogged'] = true;
                                                $_SESSION['target'] = 'listContent.php';
                                                $_SESSION['backspace'] = [];
                                                header("Location: ../");
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
            } else {
                $_SESSION['authError'] = 'Vous n\'avez pas de formulaire';
            }
            header("Location: ../");
    }
}

?>