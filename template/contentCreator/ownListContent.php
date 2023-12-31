<!doctype html>
<html lang="fr">

<?php
    include('template/header.php');
?>
    <title>Memoria Cultura - Mon contenu</title>
</head>

<body>

<?php
    include('template/navbar.php');

            if (isset($_SESSION['authError']))    {
                echo $_SESSION['authError'];
                unset($_SESSION['authError']);
            }
            
            if (!isset($_SESSION['tokens'])) {
                $token = '';
            } else {
                $nowDate = date("Y-m-d H:i:s");
                $token = md5(uniqid(mt_rand(), true));
                $tokenAssoss =[$nowDate, $token];
                array_push($_SESSION['tokens'], $tokenAssoss);
                $tokens = $_SESSION['tokens'];
            }
            if (!isset($contentsData)) {
                echo 'Un problème est survenu lors du chargement de la page';
            } else {
                echo '<a class="nav-link" href="index.php?page=addcontent">Ajouter du contenu</a>';
                include('template/contentTemplate/ownContentRows.php');
            }
    include('template/footer.php');
?>
