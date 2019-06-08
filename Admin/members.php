<?php 
// include files
     session_start();
	if (isset($_SESSION['id'])) {
	    $pagetitle = "manage members";
      include("includes.php");
	 } else {
           header("Location: index.php");
           exit();
	}

// start page

function manage_members(){
  global $go;
  global $userid; 
  global $conn;
  global $msg;

  $go = isset($_GET['go']) ? $_GET['go'] : "try again";

  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET["userid"]) : "there is no any id like this";

  // start manage paged

  if ($go == 'add') { ?> 

        
    <div class="container">
      <div class="row"> 
         <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">


                        <h2 class="text-center">Add Members</h2>

                                 <?php msg();?>
               
            <form action="?go=insert" method="POST" class="form-horizontal" enctype="multipart/form-data">
          
                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:24px'><b>Username</b></span>
                       <input  class="form-control" type="text" value='<?php old('username'); ?>' autocomplete="off" name="username" placeholder="Enter Your UserName">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:25px'><b>Password</b></span>
                       <input class="form-control" type="password"  name="password" value="" placeholder="Enter Your Password">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:54px'><b>Email</b></span>
                        <input  class="form-control" type="email" value='<?php old('email'); ?>' name="email" placeholder="Enter Your email">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:29px'><b>FullName</b></span>
                        <input  class="form-control" type="text" value='<?php old('fullName'); ?>' name="fullName" placeholder="Enter Your FullName">
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
    





  
 <?php }elseif ($go == 'insert') { 
  global $conn;

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

                 /* normal vars */

              $user       = $_POST['username'];
              $pass       = $_POST['username'];   
              $mail       = $_POST['email'];  
              $name       = $_POST['fullName'];
              $hashedpass = sha1($pass);
               
              
                 $errors = array();
               // check  if this empty
               if (empty($user)) {
                 $errors [] = "user can't be blank";
               }
                // check lenth 
               if (strlen($user) < 4 ) {
                $errors [] = "username can't be less than 4 characters";
               }
               
               if (empty($pass)) {
                              $errors [] = "password can't be blank";
                            }
               if (empty($mail)) {
                              $errors [] = "email can't be blank";
                            }
               if (empty($name)) {
                $errors [] = "name can't be blank";
               }
                
                     // check if user exist before.
               if (select_items_with_condition('username', 'users', $user) == 1) {
                     $errors [] =  "Sorry already user is exist.";
               }
                        
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


                     // echo errors
              foreach ($errors as $error) {

                  echo"<div class='container alert alert-danger'>".$error."</div>";

                }

             
                          // insert in database  
                if (empty($errors)) {

                      // Upload Image 
                     
                     $avatarName = rand(0,100000000). '_' . $avatarName;
                     move_uploaded_file($avatarTem, "public/images/".$avatarName);

                     
                      // Start Insert
                  $stmt = $conn->prepare("INSERT INTO 
                    users(username, password, email, full_name, date, group_id, avatar)
                    VALUES (:zuser, :zpass, :zmail, :zname,  now(), 0, :zavatar)
                ");
                       
                       // execute query
               $stmt->execute(array(
                     
                     'zuser'   => $user, 
                     'zpass'   => $hashedpass,
                     'zmail'   => $mail,
                     'zname'   => $name,
                     'zavatar' => $avatarName               
                ));
                   $msg = "user <b>inserted</b> successfully";
                   $_SESSION['msg'] = $msg ;
                   redirect_to('back');         
              
                 } else {
                   
                   $_SESSION['error'] = $error;
                   $_SESSION['data'] = $_POST;
                   redirect_to('back');
                 }
              
            } else {
                  
                   redirect_to('back');
                   
        }

       echo "</div>";

 } elseif ($go == 'edit') { 

    // check if userid in numric and exist 

       $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET["userid"]) :  '';

        $rows = select('*', 'users', 'WHERE user_id = ?', $userid, 'user_id');
            
            // foreach to get the value from the rows array
        
                  // if there is user id like this show this form
         if (isset($rows[0])) { 
             $row = $rows[0];
          ?>


                 <!-- Model For profile picture --> 
<div class="container profile-pic">

              <!-- Trigger the Modal -->

      <!-- The Modal -->
      <div id="picModal" class="pic-modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="pic-modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
      </div> 
  
      <br>
    <center>
      <div class'profile-pic'> 
     <div class='name'><?php echo $row['username']; ?></div> 
     <div class='pic-profile'>
       <div class='img'>
         <img id="myImg" src="public/images/<?php echo $row['avatar']; ?>"  style="width:100%;max-width:300px; height:100%">
         <button class="btn-block" href="#signup" data-toggle="modal" data-target=".bs-modal-lg"><i class='fa fa-edit'></i>Edit</button>
       </div>
     </div>
     </center><br>
   
    <hr class="prettyline">
</div>
           
             <!-- Model For Edit --> 
<div class="container">
  <div class="row"> 
   
    <!-- Modal -->
    <div class="modal col-md-12 col-sm-12 fade bs-modal-lg" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
          <div class="modal-body">
            <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="signin">
               <div class="modal-body">
                      <center>
                        <img class='avatar' src="public/images/<?php echo $row['avatar']; ?>" > 
                      </center>

                      <h3 class="text-center" style='color:#333; font-weight:bold'>Edit Profile</h3>

                    <form action="?go=update" method="POST" class="form-horizontal" enctype="multipart/form-data">

                      <p><input type="hidden" value="<?php echo $userid; ?>" name="id"></p>

                      <div class="form-group">
                        <div class="cols-sm-10">
                          <div class="input-group">
                            <span class="input-group-addon" style='padding-right:24px'><b>Username</b></span>
                            <input  class="form-control" type="text" name="username" value="<?php echo $row['username']; ?>" placeholder="Enter Your UserName">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="cols-sm-10">
                          <div class="input-group">
                            <span class="input-group-addon" style='padding-right:25px'><b>Password</b></span>
                            <input type="hidden" name="oldpassword" value="<?php echo $row['password']; ?>">
                            <input class="form-control" type="password" name="newpassword" value="" placeholder="Enter Your Password">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="cols-sm-10">
                          <div class="input-group">
                            <span class="input-group-addon" style='padding-right:54px'><b>Email</b></span>
                            <input  class="form-control" type="email" name="email" value="<?php echo $row['email'];?>" placeholder="Enter Your email">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="cols-sm-10">
                          <div class="input-group">
                            <span class="input-group-addon" style='padding-right:29px'><b>FullName</b></span>
                            <input  class="form-control" type="text" name="fullName" value="<?php echo $row['full_name'];?>" placeholder="Enter Your FullName">
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
                       <input class="form-control btn btn-primary" type="submit" name="save" value="Save">
                      </div>
                      
                    </form>
             
          </div>
        </div>
          </div>
          
           <div class="modal-footer">
            <center>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </center>
          </div>
          
        </div>
      </div>
   </div>
 </div>
</div>





        

            <!-- Profile Pictures -->
<div class="container photos-modal">
  <div class="row ">
          <h3>Photos</h3>
          <?php 
              $id = $_GET['userid'];
              $stmt = $conn->prepare("SELECT * FROM photos WHERE user_id = ? ");
              $stmt->execute(array($id));
              $count  = 1;
             //$row = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="column-out">
                         <div class="img demo cursor" style="background: url(public/images/<?php echo $row['avatar']; ?>)" style="width:100%" onclick="openModal();currentSlide('<?php echo $count; ?>')" class="hover-shadow cursor"></div>
                      </div>
                    </div>
          <?php $count = $count + 1; }?>
  </div>
 </div>
  <div id="myModal" class="modall">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modall-content">
      <div class='row center'>
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">

          <?php 
              $stmt = $conn->prepare("SELECT * FROM photos");
              $stmt->execute();
              $count  = 1;
             //$row = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                      <div class="mySlides">
                        <div class="img  cursor" style="background: url(public/images/<?php echo $row['avatar']; ?>)" style="width:100%" onclick="openModal();currentSlide('<?php echo $count; ?>')" class="hover-shadow cursor"></div>
                        <div class="numbertext"><?php echo $count. " / " . $stmt->rowCount() ;  ?></div>
                      </div> 
                    

          <?php $count = $count + 1; } ?>
      
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
    </div>
      

           <?php 
              $stmt = $conn->prepare("SELECT * FROM photos");
              $stmt->execute();
              $count  = 1;
             //$row = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-2 col-sm-6 col-xs-12 images">
                      <div class="column-inside">
                        <div class="img demo cursor" style="background: url(public/images/<?php echo $row['avatar']; ?>)" style="width:100%" onclick="currentSlide('<?php echo $count; ?>')" alt="Nature and sunrise"></div>
                      </div> 
                    </div>                    

          <?php $count = $count + 1; }?>
    </div>
  </div>










             
       <?php } else {
          echo '<div class="container alert alert-danger">there is no any id like this</div>';
         }
    ?>

       

<?php  } elseif ($go == 'update') {
  global $conn;
            echo "<h2 class='text-center'>Update Members</h2>";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {

                  // avatar vars

              $avatarTem  = $_FILES['avatar']['tmp_name'];
              $avatarSize = $_FILES['avatar']['size'];
              $avatarName = $_FILES['avatar']['name'];

              $avatarAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');
              $avatarExtention = strtolower(end(explode('.', $avatarName)));
  
                    // normal vars

              $id   = $_POST['id'];
              $user = $_POST['username'];
              $pass = '';    
              $mail = $_POST['email'];  
              $name = $_POST['fullName'];
               
              $pass = empty($_POST['newpassword']) ? sha1($_POST['oldpassword']) : sha1($_POST['newpassword']);
              
               $errors = [];

                 //check  if this empty     
                 if (empty($user)) {
                   $errors [] = "username can't be blank";
                 }
                // check lenth 
               if (strlen($user) < 4 ) {
                $errors [] = "username can't be less than 4 characters";
               }
               
               if (empty($mail)) {
                              $errors [] = "email can't be blank";
                            }
               if (empty($name)) {
                $errors [] = "name can't be blank";
               }
               
               $x ="AND user_id <> {$id}";
              if (select_items_with_condition('username', 'users', $user, $x) == 1) {

                 $errors[] =  "Sorry already user is exist.";

               }
                      // check pic
              if (!empty($avatarName) && !in_array($avatarExtention, $avatarAllowedExtention)) {
                       $errors [] = "This Exetention isn't Allowed Only ( jpg, jpeg, png, gif )";
                    }

              
              if ($avatarSize > 2194304) {
                       $errors [] = "Avatar Can't Be More Than 2MB";
                    }


                  // echo errors
              foreach ($errors as $error) {
                  echo"<div class='container alert alert-danger'>".$error."</div>";
                }


              
             if (empty($errors)) {   


                  if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {

                    // echo $avatarName;
                    // die();

                       $row = select('*', 'users', 'WHERE user_id = ?', $id, 'user_id', 'DESC', 1); 

                       $path = "/public/images/".$row[0]['avatar']; 

                       unlink(__DIR__.$path);                 
                     
                       $avatarName = rand(0,100000000). '_' . $avatarName;
                       move_uploaded_file($avatarTem, "public\images\\".$avatarName);

                       $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ?, full_name = ?, avatar = ? WHERE user_id = ?");
                   
                       $stmt->execute(array($user , $mail, $pass, $name, $avatarName, $id));  
                       
                       $msg = "user <b>Updated</b> successfully";
                       $_SESSION['msg'] = $msg ;
                       redirect_to('back'); 
                   } else {
                       $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ?, full_name = ? WHERE user_id = ?");
                   
                       $stmt->execute(array($user , $mail, $pass, $name, $id));  
                       
                       $msg = "user <b>Updated</b> successfully";
                       $_SESSION['msg'] = $msg ;
                       redirect_to('back'); 
                   }

                           
              
                 } else {
                   
                   $_SESSION['error'] = $error;
                   $_SESSION['data'] = $_POST;
                   redirect_to('back');
                 }
      
  
          }


} elseif ($go == 'members') {  
  
     $rows = select('*', 'users', '', '', 'user_id');
  ?>

     <div class="container member-table table-responsive">
          <h2 class='text-center'>Members<br><br></h2>

             <!--  success message -->
                 <?php msg();?>

          <table class="table table-striped text-center">
            <thead>
              <tr >
                <th>#Id</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Email</th>
                <th>FullName</th>
                <th>Register Date</th>
                <th>Control</th>
                
              </tr>
            </thead>
            <tbody>
              
               
                <?php
                  foreach ($rows as $row) { ?>
                     <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td>
                          <?php 
                                if (!empty($row['avatar'])) {
                                  echo "<img class='avatar' src='public/images/".$row["avatar"]."'>";
                                 } else {
                                  echo "<img class='avatar' src='public/images/user.png'>";
                                 } 
                             ?>    
                        </td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['date']; ?></td>                        
                        <td> 
                           <a href='members.php?go=edit&userid=<?php echo $row['user_id'];?>' class='btn btn-small btn-success'><i class='fa fa-edit'></i> Edit</a>
                           <a href='members.php?go=delete&userid=<?php echo $row['user_id'];?>' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
                        </td>
                   </tr>

                    <!-- end foreach -->
                 <?php } ?>  
            </tbody>
          </table>
          <a href='members.php?go=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Members</a>
    </div>


 <?php } elseif ($go == 'delete') {  
  global $conn;

        // check if userid in numric and exist 

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET["userid"]) : "there is no any id like this";
                
                /*check if there is user with this ID or no */
        $check = select('*', 'users', 'WHERE user_id = ?', $userid, 'user_id', 'DESC', 1);

                  // if there is user id like this show this form
         if (isset($check) && !empty($check)) { 
               delete('users', 'user_id', $userid);
            }

   } elseif ($go == "acceptPending") {

          $id   = $_GET['userid'];

          if (!isset($_GET['id'])) {

              $stmt = $conn->prepare("UPDATE users SET reg_status = 1 WHERE user_id = ? LIMIT 1 ");

                    $stmt->execute(array($id));  
                     
                    $msg = "user <b>Accepted</b> successfully";
                    $_SESSION['msg'] = $msg ; 
                    redirect_to('back');    
                   

          }

         

       } 
            else {

    echo "fix your code";
  }
}

manage_members();








 ?>




















<script>
     $("#close").click(function(){
     $(".x").hide(); 
});</script>

	
<!-- include footer -->
<?php include("includes/templates/footer.php");?>
