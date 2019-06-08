<!-- iclude files -->
<?php 
// include files
     session_start();
  if (isset($_SESSION['user'])) {
      $pagetitle = "Sections";
      include("includes.php");

   } else {
           header("Location: login.php");
           exit();
  }
?>

 
<div class='container sections'>
    
    <div class='row'>


           <?php
               if (isset($_GET['tag'])) {

                  $tag = $_GET['tag'];
                  echo "<h1>{$tag}</h1>";

                $items =  select('*', 'items', "WHERE tags like '%$tag%' AND approve = 1");
           
                  foreach ($items as $item) {
                          echo "<div class='col-md-3 col-sm-4 item-box'>";
                               echo "<div class='main'>";
                                 echo "<img src='pic.jpg' class='img-responsive'>";
                                 echo "<ul class='txt'>";
                                   echo "<li class='link'><a href='ads.php?ad=show&itemid={$item['id']}'>{$item['name']}</a></li>";
                                   echo "<li class='desc'>{$item['description']}</li>";
                                   echo "<span class='price'><span>$</span>{$item['price']}</span>";
                                   echo "<span class='date'>".$item['date']."</span>";
                                   // echo "<li class=''>Published In: {$item['date']}</li>";
                                 echo "</ul>";
                               echo "</div>";
                          echo "</div>";
                        } 
               }else {
                  echo "<div class='alert alert-danger'>Type Correct Tag</div>";
                }
              
          ?>
    </div>
</div>
              
	
<!-- include footer -->
<?php include("../admin/includes/templates/footer.php");?>