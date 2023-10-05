<?php
    include('header.html');
?>

<?php
    include('navbar.php');
?>

<body>
  

  <div class="main-container" class="main-container">
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
          <img src="../img/Capture d'écran 2023-10-04 112429.png" class="rounded" width="700" height="200">
      </div>
  </div>

  <section class="timeline">
    <ol>
      <li>
        <div>
          <time>1934</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1937</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1940</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1943</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1946</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1956</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1957</time>
        </div>
      </li>
      <li>
        <div>
          <time>1967</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1977</time> 
        </div>
      </li>
      <li>
        <div>
          <time>1985</time> 
        </div>
      </li>
      <li>
        <div>
          <time>2000</time> 
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
</body>

<?php
    include('footer.html');
?>

<script src="../js/frisechrono.js"></script>
