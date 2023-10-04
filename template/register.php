<!doctype html>
<html lang="fr">

<?php
    include('template/header.html');
?>
    <title>Memoria Cultura - Connexion</title>
</head>

<body>

<?php
    include('template/navbar.php');

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
            echo '
            <div class="container mt-3">
                <form action="index.php?page=connexion" method="post">
                    <h1>Connectez-vous</h1>
                    <input type="hidden" name="token" value="'.$token.'">
                    <input type="hidden" name="sendDate" value="'.$nowDate.'">
                    <label for="inputPseudo" class="sr-only">Pseudo:</label>
                    <input data-span="divPseudo" type="text" id="inputPseudo" name="inputPseudo" class="form-control" placeholder="Pseudo" required autofocus>
                    <label for="inputPassword" class="sr-only">Mot de passe:</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btRegister">Se connecter</button>
                </form>
            </div>
        ';
    include('template/footer.html');
?>
