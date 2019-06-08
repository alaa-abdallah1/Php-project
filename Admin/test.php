 <?php 
// include files
     session_start();
  if (isset($_SESSION['id'])) {
      $pagetitle = "Items";
      include("includes.php");    
   } else {
           header("Location: index.php");
           exit();
  }


  // seletion
   $rows = select('*', 'users', null,null, 'user_id','DESC',1000);
 
// start page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

          echo "<div class='container'>";
                     
              /* upload files */ 
               // print_r($_FILES['avatar']);              
               // $avatarType = $_FILES['avatar']['type'];

               $avatarTem  = $_FILES['avatar']['tmp_name'];
               $avatarSize = $_FILES['avatar']['size'];
               $avatarName = $_FILES['avatar']['name'];
               $avatarAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
               $avatarExtention = strtolower(end(explode('.', $avatarName)));

               $id = $_POST['member']; 

               $errors = array();
                // check pic
              if (!empty($avatarName) && !in_array($avatarExtention, $avatarAllowedExtention)) {
                       $errors [] = "This Exetention isn't Allowed Only ( jpg, jpeg, png, gif )";
                    }

              if (empty($avatarName)) {
                       $errors [] = "Avatar Is Required";
                    }

              if ($avatarSize > 2194304) {
                       $errors [] = "Avatar Can't Be More Than 2MB";
                    }

              if (empty($errors)) {

                    // Upload Image 
                   
                   $avatarName = rand(0,100000000). '_' . $avatarName;
                   move_uploaded_file($avatarTem, "public\images\\".$avatarName);

                $stmt = $conn->prepare("INSERT INTO 
                    photos(avatar, date, user_id)
                    VALUES (:zavatar, now(), :zid)
                ");
                       
                       // execute query
                  $stmt->execute(array(
                     'zavatar' => $avatarName,               
                     'zid'     => $id
                ));
                   $msg = "Photo <b>inserted</b> successfully";
                   $_SESSION['msg'] = $msg ;
                   redirect_to('back');         
              
                 } else {
                   
                   $_SESSION['error'] = $error;
                   $_SESSION['data'] = $_POST;
                   redirect_to('back');
                 }
              
               
}




?>    


        <h2 class="text-center">Gallary</h2>

                         
    <div class="container">
      <div class="row"> 
         <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">
                       <!--  success message -->
                          <?php msg();?>

               <form action="?go=insert" method="POST" class="form-horizontal" enctype="multipart/form-data">

                 <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:31px'><b>Members</b></span>
                        <div class='form-control'>
                              <select name='member'>
                                <?php 
                                      foreach ($rows as $row) {
                                      echo " <option value='{$row['user_id']}'>{$row['username']}</option>";
                                    }
                                ?>
                              </select>
                        </div>
                      </div>
                    </div>
                  </div>
          
                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:49px'><b>Avater</b></span>
                        <input  class="form-control" type="file" name="avatar" value="<?php old('avatar'); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group ">
                   <input class="form-control btn btn-primary" type="submit" name="add" value="add">
                  </div>
                  
            </form>

       </div>
      </div>
    </div> 

            <!-- Gallary -->
<!--     <div class="container">
      <div class="row"> 
            <h2 class="text-center">Profile Pictures</h2>

             <?php 
                
                foreach ($rows as $row) { 
                   if (!empty($row['avatar'])) {?>
                      <div class="col-md-3 col-sm-6 col-xs-12 gallary">
                        <div class=''>
                          <img src="public/images/<?php echo $row['avatar'];?>">
                        </div>
                      </div>

             <?php } }?>


          
        
      </div>
    </div>  -->

  <!-- Gallary -->
   <!--  <div class="container">
      <div class="row"> 
            <h2 class="text-center">Profiles</h2>

             <?php 
                
                foreach ($rows as $row) { 
                   if (!empty($row['avatar'])) {?>
                    <a href="members.php?go=edit&userid=<?php echo $row['user_id']; ?>">
                      <div class="col-md-3 col-sm-6 col-xs-12 gallary">
                        <div class='main'>
                          <div class='img'  style="background: url(public/images/<?php echo $row['avatar'];?>)">
                          </div>
                          <div class='txt'>
                             <?php echo $row['username']; ?>
                          </div>  
                        </div>
                      </div>
                    </a>
             <?php } }?>


          
        
      </div>
    </div> 
 -->



<!-- Container for the image gallery -->

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="img_chania.jpg" alt="Chania" width="460" height="345">
        <div class="carousel-caption">
          <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
        </div>
      </div>
    
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>










<!-- include footer -->
<?php include("includes/templates/footer.php");?>   