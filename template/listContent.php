<!doctype html>
<html lang="fr">

<?php
    include('template/header.html');
?>
    <title>Memoria Cultura - Accueil</title>
</head>

<body>

<?php
    include('template/navbar.php');

    require_once dirname(__DIR__).'/config/connexion.php';

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
            Mettre l\'acceuil
        ';
    include('template/footer.html');
?>
