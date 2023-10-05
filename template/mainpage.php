<?php
    include('header.php');
?>

    <title>Memoria Cultura - Accueil</title>
</head>

<?php
    include('navbar.php');
?>
  <div class="main-container">
    <div class="select-menu">
        <select class="form-select" aria-label="select-container">
            <option selected>Lieu ?</option>
            <option value="1">Lens</option>
            <option value="2">Lille</option>
            <option value="3">Arras</option>
        </select>

        <select class="form-select" aria-label="select-container">
            <option selected>Quand ?</option>
            <option value="1">1940</option>
            <option value="2">1960</option>
            <option value="3">2000</option>
        </select>
    </div>
      <div class="text-center">
      <?php echo '<img src="'.GET_SOURCES.'img/Capture d\'écran 2023-10-04 112429.png" class="rounded" width="700" height="200">'?>
      </div>
  </div>

  <section class="timeline">
    <ol>
      <li>
        <div>
          <time>52 av. J.-C</time> Bataille de Gergovie
        </div>
      </li>
      <li>
        <div>
          <time>476</time> Chute de l'Empire romain d'Occident
        </div>
      </li>
      <li>
        <div>
          <time>496</time> Conversion de Clovis au christianisme
        </div>
      </li>
      <li>
        <div>
          <time>732</time> Bataille de Poitiers (ou Tours)
        </div>
      </li>
      <li>
        <div>
          <time>843</time> Traité de Verdun
        </div>
      </li>
      <li>
        <div>
          <time>1066</time> Guillaume le Conquérant envahit l'Angleterre
        </div>
      </li>
      <li>
        <div>
          <time>1337-1453</time> Guerre de Cent Ans
        </div>
      </li>
      <li>
        <div>
          <time>1429</time> Jeanne d'Arc mène les troupes françaises à la victoire à Orléans
        </div>
      </li>
      <li>
        <div>
          <time>1515</time> François Ier devient roi de France
        </div>
      </li>
      <li>
        <div>
          <time>1789</time> Prise de la Bastille, début de la Révolution française
        </div>
      </li>
      <li>
        <div>
          <time>1792</time> Proclamation de la République
        </div>
      </li>
      <li>
        <div>
          <time>1804</time> Napoléon devient empereur
        </div>
      </li>
      <li>
        <div>
          <time>1815</time> Défaite de Napoléon à Waterloo
        </div>
      </li>
      <li>
        <div>
          <time>1830</time> Révolution de Juillet, début de la monarchie de Juillet
        </div>
      </li>
      <li>
        <div>
          <time>1848</time> Révolution de février, proclamation de la Deuxième République
        </div>
      </li>
      <li>
        <div>
          <time>1852</time> Napoléon III devient empereur
        </div>
      </li>
      <li>
        <div>
          <time>1870</time> Défaite française lors de la guerre franco-prussienne
        </div>
      </li>
      <li>
        <div>
          <time>1889</time> Exposition universelle à Paris, Tour Eiffel inaugurée
        </div>
      </li>
      <li>
        <div>
          <time>1914-1918</time> Première Guerre mondiale
        </div>
      </li>
      <li>
        <div>
          <time>1940</time> Occupation allemande de la France pendant la Seconde Guerre mondiale
        </div>
      </li>
      <li>
        <div>
          <time>1944</time> Libération de la France
        </div>
      </li>
      <li>
        <div>
          <time>1957</time> Signature du traité de Rome, début de la CEE
        </div>
      </li>
      <li>
        <div>
          <time>1968</time> Les événements de Mai 1968
        </div>
      </li>
      <li>
        <div>
          <time>1989</time> Célébration du bicentenaire de la Révolution française
        </div>
      </li>
      <li>
        <div>
          <time>2002</time> Passage à l'euro
        </div>
      </li>
      <li></li>
    </ol>

    <div class="arrows">
      <button class="arrow arrow__prev disabled" disabled>
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/arrow_prev.svg" alt="prev timeline arrow">
      </button>
      <button class="arrow arrow__next">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/arrow_next.svg" alt="next timeline arrow">
      </button>
    </div>
  </section>

  <div class="main-container-cards">
    <div class="card" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>

    <div class="card" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>

    <div class="card" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>

</body>

<?php
    include('footer.php');
    echo '<script src='.GET_SOURCES.'"js/frisechrono.js"></script>';
?>

