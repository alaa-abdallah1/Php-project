
<!DOCTYPE html>
<html lang="en">
<head>
 
  <title><?php get_title(); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!--=================== css file ==================-->
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/public.css" type="text/css">
   
</head>
    
    <!--=================== start page ===========-->
<body>

<?php 

if (isset($_SESSION['user'])) {

             check_status($_SESSION['user']);

             if ($count == 1) {

                  echo "<div class='container-fluid con-status  alert alert-danger text-center'>";
                      echo "<div>Your Profile Need To Activate</div>";
                  echo "</div>";   
              }

} 



?>  

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>

    <a class="navbar-brand" href="index.php">HomePage</a>
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right links">
          
           <?php 
                        // the links
                       $links = select('*', 'sections','WHERE parent = 0', '', 'name', 'DESC');
                       foreach ($links as $link) {
                            echo "<li><a href='sections.php?pageid={$link['id']}&pagename={$link['name']}'>{$link['name']}</a></li>";
                       }
                    
                        // Dropdown and login button
                      if (isset($_SESSION['user'])) { ?>

                           <ul class="nav navbar-nav navbar-right">
                            <a href="profile.php"><img src='pic.jpg' class='img-circle img-profile'></a>
                              <li class="dropdown">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  <?php   echo  $_SESSION['user']; ?><span class="caret"></span>   
                                </a>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a href="profile.php"><?php  echo  $_SESSION['user']; ?>Profile</a>
                                    
                                  </li>
                                  <li><a href="../admin/index.php">Visit Admin</a></li>
                                  <li><a href="ads.php?ad=add">Add New Ad</a></li>
                                  <li><a href="logout.php">Log Out</a></li>
                                </ul>
                              </li>
                            </ul>

                  <?php  

                     

                    } else {
                         echo "<a href='login.php' class='navbar-right btn btn-primary nav-log'>LogIn/SignUP</a>";
                      }
           ?>
          
      </ul>
    </div>
  </div>
</nav>

