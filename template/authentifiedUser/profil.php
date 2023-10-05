<!doctype html>
<html lang="fr">

<?php
    include('template/header.php');
?>
    <title>Memoria Cultura - Profil</title>
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

            if (!isset($userData)) {
                echo 'Un problème est survenu lors du chargement de la page';
            } else {
                $longDesc = '';
                if ($userData['long_desc'] != null) {
                    $longDesc = $userData['long_desc'];
                }
                echo '
            <div class="container mt-3">
                <form action="index.php?page=profil" method="post">
                    <h1>Mon profil</h1>
                    <input type="hidden" name="token" value="'.$token.'">
                    <input type="hidden" name="sendDate" value="'.$nowDate.'">
                    <label for="inputEmail" class="sr-only">Email:</label>
                    <input data-span="divEmail" type="email" id="inputEmail" name="inputEmail" class="form-control" style="margin-bottom: 1rem;" value="'.$userData['email'].'" required>
                    <label for="inputNom" class="sr-only">Nom:</label>
                    <input data-span="divNom" type="text" id="inputNom" name="inputNom" class="form-control" style="margin-bottom: 1rem;" value="'.$userData['nom'].'" required>
                    <label for="inputPrenom" class="sr-only">Prénom:</label>
                    <input data-span="divPrenom" type="text" id="inputPrenom" name="inputPrenom" class="form-control" style="margin-bottom: 1rem;" value="'.$userData['prenom'].'" required>
                    <label for="inputShortDesc" class="sr-only">Description courte:</label>
                    <input type="text" id="inputShortDesc" name="inputShortDesc" class="form-control" style="margin-bottom: 1rem;" value="'.$userData['short_desc'].'" required>
                    <label for="inputShortDesc" class="sr-only">Description:</label>
                    <input type="text" id="inputLongDesc" name="inputLongDesc" class="form-control" style="margin-bottom: 1rem;" value="'.$longDesc.'" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btUserModify">Modifier</button>
                </form>
            </div>
                ';
            ?>
            <div class="main-container-abonnement">
  <h1 class="title-abonnement">Les abonnements disponible</h1>
  <div class="sub-container-abonnement">
    

    <div class="card-abo" style="width: 25rem; height: 40rem; padding: 2rem;">
    <?php echo '<img src="'.GET_SOURCES.'img/GodfreyKneller-IsaacNewton-1689.jpg" class="card-img-top" alt="...">'?>
      <div class="card-body-abonnement">
        <h5 class="card-title">Abonnement Newton</h5>
        <p class="card-text">8.99€ / mois</p>
        <p class="card-text">SANS PUB</p>
        <p class="card-text">5 conférences</p>
        <a href="#" class="btn btn-primary">Je m'abonne</a>
      </div>
    </div>

    <div class="card-abo" style="width: 25rem; height: 40rem; padding: 2rem;">
    <?php echo '<img src="'.GET_SOURCES.'img/Aristotebuste_epoque_romaine.png" class="card-img-top" alt="...">'?>
      <div class="card-body-abonnement">
        <h5 class="card-title">Abonnement Aristote</h5>
        <p class="card-text">12.99€ / mois</p>
        <p class="card-text">SANS PUB</p>
        <p class="card-text">Conférences illimitées sans interaction</p>
        <a href="#" class="btn btn-primary">Je m'abonne</a>
      </div>
    </div>

    <div class="card-abo" style="width: 25rem; height: 40rem; padding: 2rem;">
    <?php echo '<img src="'.GET_SOURCES.'img/Atelier_de_Nicolas_de_Largillière,_portrait_de_Voltaire,_détail_(musée_Carnavalet)_-002.jpg" class="card-img-top" alt="...">'?>
      <div class="card-body-abonnement">
        <h5 class="card-title">Abonnement Voltaire</h5>
        <p class="card-text">19.99€ / mois</p>
        <p class="card-text">SANS PUB</p>
        <p class="card-text">Conférences interactives illimitées</p>
        <a href="#" class="btn btn-primary">Je m'abonne</a>
      </div>
    </div>
  </div>
</div>
<?php
            }
    include('template/footer.php');
?>
