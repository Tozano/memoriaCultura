<!doctype html>
<html lang="fr">

<?php
    include('template/header.php');
?>
    <title>Memoria Cultura - Ajout de contenu</title>
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
            }  else {
                $nowDate = date("Y-m-d H:i:s");
                $token = md5(uniqid(mt_rand(), true));
                $tokenAssoss =[$nowDate, $token];
                array_push($_SESSION['tokens'], $tokenAssoss);
                $tokens = $_SESSION['tokens'];
            }
            echo '
            <div class="container mt-3">
                <form action="index.php?page=addcontent" method="post">
                    <h1>Contenu à ajouter</h1>
                    <input type="hidden" name="token" value="'.$token.'">
                    <input type="hidden" name="sendDate" value="'.$nowDate.'">
                    <label for="inputTitle" class="sr-only">Titre:</label>
                    <input data-span="divTitle" type="text" id="inputTitle" name="inputTitle" class="form-control" style="margin-bottom: 1rem;" placeholder="Titre" required autofocus>
                    <label for="inputDesc" class="sr-only">Description:</label>
                    <input data-span="divDesc" type="text" id="inputDesc" name="inputDesc" class="form-control" style="margin-bottom: 1rem;" placeholder="Description" required>
                    <label for="inputAddress" class="sr-only">Adresse:</label>
                    <input data-span="divAddress" type="text" id="inputAddress" name="inputAddress" class="form-control" style="margin-bottom: 1rem;" placeholder="Adresse" required>
                    <label for="inputYear" class="sr-only">Année:</label>
                    <input type="text" id="inputYear" name="inputYear" class="form-control" style="margin-bottom: 1rem;" placeholder="Année" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btAddContent">S\'inscrire</button>
                </form>
            </div>
        ';
    include('template/footer.php');
?>
