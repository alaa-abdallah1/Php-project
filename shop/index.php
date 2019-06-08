<!-- iclude files -->
<?php 
// include files
     session_start();
  if (isset($_SESSION['user'])) {
      $pagetitle = "Profile";
      include("includes.php");

   } else {
           header("Location: login.php");
           exit();
  }
?>


<div class='container'>
  <div class='row'>

    <?php 
        
           $allItems =  select('*', 'items', 'WHERE approve = 1');

                foreach ($allItems as $item) {
                          echo "<div class='col-md-3 col-sm-4 item-box'>";
                               echo "<div class='main'>";
                                 echo "<img src='pic.jpg' class='img-responsive'>";
                                 echo "<ul class='txt'>";
                                   echo "<li><a href='ads.php?ad=show&itemid={$item['id']}'>{$item['name']}</a></li>";
                                   echo "<li class='desc'>{$item['description']}</li>";
                                   echo "<span class='price'><span>$</span>{$item['price']}</span>";
                                   echo "<span class='date'>".$item['date']."</span>";
                                   // echo "<li class=''>Published In: {$item['date']}</li>";
                                 echo "</ul>";
                               echo "</div>";
                          echo "</div>";
                        }
          ?>
    </div>
</div>        











<!-- include footer -->
<?php include("../admin/includes/templates/footer.php");?>