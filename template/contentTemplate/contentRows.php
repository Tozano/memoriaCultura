<?php
$contentsNumber = count($contentsData);
$numberOfFullRows = floor($contentsNumber/3);

$cardCounter = 0;
for ($i=0; $i < $numberOfFullRows; $i++) { 
  ?>
  <div class="main-container-cards">
  <?php
  for ($j=0; $j < 3; $j++) { 
    include('template/contentTemplate/singleCard.php');
    $cardCounter++;
  }
  ?>
  </div>
  <?php
}
if ($contentsNumber % 3 != 0) {
  ?>
  <div class="main-container-cards">
  <?php
  for ($j=$cardCounter; $j < $contentsNumber; $j++) { 
      include('template/contentTemplate/singleCard.php');
      $cardCounter++;
  }
  ?>
  </div>
  <?php
}
