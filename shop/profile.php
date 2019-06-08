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

<?php

           // Get User Information
$get = $conn->prepare("SELECT * FROM users WHERE username = ?");
$get->execute(array($_SESSION['user']));
$rows = $get->fetchAll();



$comments = select(" users.*, comments.user_id, comments.comment, comments.date AS now", "users",
                        "INNER JOIN comments ON comments.user_id = users.user_id 
                         WHERE username = ?", $_SESSION['user']
                         ); 
 ?>

<div class='container'>
	<div class='row'>
		<h1>profile</h1>
                 
                 <!-- information -->
		  <div class="panels">
     	 <div class="col-sm-12 col-xs-12">
            <div class="panel panel-primary">

			  <div class="panel-heading">My Information
                <span class='pull-right toggle-info'>
                	<i class='fa fa-plus'></i>
                </span>
			  </div>

			  <div class="panel-body profile">
                 <ul>
                    <?php 
                          foreach ($rows as $row) { ?>

                          <li>
                            <span><i class='fa fa-lock fa-fw'></i>Login Name</span>
                            <span class='php'>: <?php echo $row['username']; ?></span>
                          </li>

                          <li>
                            <span><i class='glyphicon glyphicon-envelope fa-fw'>
                            </i>Email</span>
                            <span class='php'>: <?php echo $row['email'];?></span>
                          </li>

                         	<li>                           
                             <span><i class='fa fa-user fa-fw'></i>fullName</span>
                             <span class='php'>: <?php echo $row['full_name'];?></span>
                           </li>

                         	<li>
                            <span class='txt'><i class='fa fa-calendar fa-fw'></i>Register Date</span>
                            <span class='php'>: <?php echo $row['date'];?></span>
                          </li>


                       <?php   } ?>
                 </ul>   
			  </div>
			</div>

        </div>
           
                 <!-- Ads -->
        <div class="panels">
     	 <div class="col-sm-12 col-xs-12">
            <div class="panel panel-primary">
            	
			  <div class="panel-heading"> Ads
                <span class='pull-right toggle-info'>
                	<i class='fa fa-plus'></i>
                </span>
			  </div>

			  <div class="panel-body">
                       <?php
			              
			              
			           
			              $stmt2 = $conn->prepare("SELECT * FROM items WHERE members_id = ? ORDER BY id DESC");

			              $stmt2->execute(array($row{'user_id'}));

			              $items = $stmt2->fetchAll();
			              
			              if (!empty($items)) {
                          foreach ($items as $item) {
                          echo "<div class='col-md-3 col-sm-4 item-box'>";
                               echo "<div class='main'>";
                                if ($item['approve'] == 0) {
                                      echo "<span class='question'>Waiting for approval</span>";
                                   } 
                                 echo "<img src='pic.jpg' class='img-responsive'>";
                                 echo "<ul class='txt'>"; 
                                  if ($item['approve'] == 0) {
                                     echo "<li class='off'><a>{$item['name']}</a></li>";
                                   } else{echo "<li><a href='ads.php?ad=show&itemid={$item['id']}'>{$item['name']}</a></li>";}                                 
                                   echo "<li class='desc'>{$item['description']}</li>";
                                   echo "<span class='price'><span>$</span>{$item['price']}</span>";
                                   // echo "<li class=''>Published In: {$item['date']}</li>";
                                 echo "</ul>";
                               echo "</div>";
                          echo "</div>";
                        }
                    } else {
                      echo "<p class='nothing'>there is no any ads to show it</p><a href='ads.php'>";
                    }
			          ?>
			  </div>
			</div>

        </div>

  
                 <!-- comments -->
    <div class="panels">
     	 <div class="col-sm-12 col-xs-12">
            <div class="panel panel-primary">
            	
			  <div class="panel-heading">Latest Comments
                <span class='pull-right toggle-info'>
                	<i class='fa fa-plus'></i>
                </span>
			  </div>

			  <div class="panel-body">
                   <?php
                       if (!empty($items)) {  
                            foreach ($comments as $comment) {
                            	echo "comments: " .$comment['comment'].'<br>';
                           	echo "Date: "     .$comment['now'].'<br>';
                           	
                            }
                         } else {
                      echo "<p class='nothing'>there is no any comments to show it</p>";
                    } 
                    ?>
			  </div>
			</div>

        </div>




	</div>









<!-- include footer -->
<?php include("../admin/includes/templates/footer.php");?>