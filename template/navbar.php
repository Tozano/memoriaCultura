<!doctype html>
<html lang="fr">
<nav class="navbar navbar-expand-lg navbar-light bg-brown">
  <div class="container-fluid">
    <div class="container">
      <a class="navbar-brand" href="index.php?page=accueil">
      <?php echo '<img src="'.GET_SOURCES.'img/Curated_online_exhibitons-removebg-icon.png" class="img-memoria" alt="" width="190" height="140">'?>
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
        if (!isset($_SESSION['login'])) {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=connexion">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=inscription">Inscription</a>
        </li>
        <?php
        } else {
          if ($_SESSION['role'] == 1) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=mycontent">Mon contenu</a>
            </li>
          <?php
          }
          ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=profil">Profil</a>
            </li>
          <?php
          ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=deconnexion">Déconnexion</a>
            </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>  
