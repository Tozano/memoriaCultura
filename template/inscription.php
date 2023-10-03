<!doctype html>
<html lang="fr">

<?php
    include('template/header.html');
?>
    <title>Memoria Cultura - Accueil</title>
</head>

<body>

<?php
    require_once 'bd/config.php';
    require_once 'bd/connexion.php';

    $db = connect($config);
        if ($db == null) {
            echo '
                <div class="container mt-3">
                    Revenez dans quelques instants
                </div>
                ';
        } else {
            if (!isset($_SESSION['tokens'])) {
                $token = '';
            } else if (isset($_SESSION['authError']))    {
                echo $_SESSION['authError'];
                unset($_SESSION['authError']);
            } else {
                $nowDate = date("Y-m-d H:i:s");
                $token = md5(uniqid(mt_rand(), true));
                $tokenAssoss =[$nowDate, $token];
                array_push($_SESSION['tokens'], $tokenAssoss);
                $tokens = $_SESSION['tokens'];
            }
            print_r($tokenAssoss);
            echo '
            <div class="container mt-3">
                <form action="inscription.php" method="post">
                    <h1>Inscrivez-vous</h1>
                    <input type="hidden" name="token" value="'.$token.'">
                    <input type="hidden" name="sendDate" value="'.$nowDate.'">
                    <label for="inputPseudo" class="sr-only">Pseudo:</label>
                    <input data-span="divPseudo" type="text" id="inputPseudo" name="inputPseudo" class="form-control" placeholder="Pseudo" required autofocus>
                    <label for="inputEmail" class="sr-only">Email:</label>
                    <input data-span="divEmail" type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required>
                    <div class="divError" id="divEmail"><span>Erreur sur l\'email</span></div>
                    <label for="inputPassword" class="sr-only">Mot de passe:</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <div class="divError" id="divPassword"><span>Erreur sur le mot de passe</span></div>
                    <label for="inputPassword2" class="sr-only">Mot de passe:</label>
                    <input type="password" id="inputPassword2" name="inputPasswordConf" class="form-control" placeholder="Confirmation mot de passe" required>
                    <label for="inputNom" class="sr-only">Nom:</label>
                    <input data-span="divNom" type="text" id="inputNom" name="inputNom" class="form-control" placeholder="Nom" required>
                    <div class="divError" id="divNom"><span>Erreur sur le nom</span></div>
                    <label for="inputPrenom" class="sr-only">Prénom:</label>
                    <input data-span="divPrenom" type="text" id="inputPrenom" name="inputPrenom" class="form-control" placeholder="Prenom" required>
                    <div class="divError" id="divPrenom"><span>Erreur sur le prénom</span></div>
                    <label for="inputShortDesc" class="sr-only">Description courte:</label>
                    <input type="text" id="inputShortDesc" name="inputShortDesc" class="form-control" placeholder="Description courte" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btInscrire">S\'inscrire</button>
                </form>
            </div>
        ';
        }
    include('template/footer.html');
?>
