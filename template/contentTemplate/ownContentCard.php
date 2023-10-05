<div class="card" style="width: 18rem;">
      <div class="card-body">
      <?php
        echo'<h5 class="card-title">'.$contentsData[$j]['title'].' <a href="index.php?page=removecontent&contentId='.$contentsData[$j]['content_id'].'"><i class="bi bi-x"></i></a></h5>
        <p class="card-text">'.$contentsData[$j]['content_desc'].'</p>';
        ?>
        <a href="#" class="btn btn-primary">Lien</a>
      </div>
    </div>