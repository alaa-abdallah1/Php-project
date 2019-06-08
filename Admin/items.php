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

// start page


function manage_items(){
  global $go;
  global $secid; 
  global $conn;
  global $msg;

  $go = isset($_GET['go']) ? $_GET['go'] : "try again";
  // start manage paged

    if ($go == 'manage') {  

      $rows = select("items.*,sections.name  AS section_name, users.username AS username, users.user_id  AS userid", "items",
                        "INNER JOIN sections ON sections.id = items.sec_id 
                         INNER JOIN users ON users.user_id = items.members_id"); 
  ?>

     <div class="container member-table table-responsive">
          <h2 class='text-center'>Add Itmes<br><br></h2>
          
                        <!--  success message -->
                             <?php msg();?>

          <table class="table table-striped text-center">
            <thead>
              <tr >
                <th>#Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Country Of Made</th>
                <th>Status</th>
                <th>Date</th>
                <th>Sec_ID</th> 
                <th>Member_ID</th>
                <th>Control</th>

              </tr>
            </thead>
            <tbody>
              
               
                <?php
                  foreach ($rows as $row) {
                   echo "<tr>";
  
                    echo "<td>". $row['id']             . "</td>" ;
                    echo "<td>". $row['name']           . "</td>" ;
                    echo "<td>". $row['description']    . "</td>" ;
                    echo "<td>". $row['price']          . "</td>" ;
                    echo "<td>". $row['country_made']   . "</td>" ;
                    echo "<td>". $row['status']         . "</td>" ;
                    echo "<td>". $row['date']           . "</td>" ;
                    echo "<td>". $row['section_name']   . "</td>" ;
                    echo "<td>". $row['username']       . "</td>" ;
                   

                     echo "<td> 
                             <a href='items.php?go=edit&itemid={$row['id']}&userid={$row['userid']}' class='btn btn-small btn-success'><i class='fa fa-edit'></i> Edit</a>
                             <a href='items.php?go=delete&itemid={$row['id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
                             if ($row['approve'] == 0) {
                          echo " <span class='span-right'><a href='items.php?go=acceptPending&itemid={$row['id']}&userid={$row['userid']}' class='btn btn-info'><i class='fa fa-check'></i> Accept</a></span>";
                        }  
                     echo "</td>" ;


                   echo "</tr>";

                
                  }

                ?>

               
             

              
            </tbody>
          </table>
          <a href='items.php?go=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Items</a>
    </div>




 <?php } elseif ($go == 'add') { ?> 

            <div class="container">
              <div class="row"> 
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1  col-xs-12">
                  
                      <h2 class="text-center">Add New Item</h2>

                         <!--  success message -->
                             <?php msg();?>

        <form action="?go=insert" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:41px'><b>Name</b></span>
                        <input required class="form-control" type="text"  name="name" value="" placeholder="Description Your Item Name">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:2px'><b>Description</b></span>
                        <input required class="form-control" type="text"  name="description" value="" placeholder="Description Your Item">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:45px'><b>Price</b></span>
                        <input required class="form-control" type="text"  name="price" value="" placeholder="Description Your Item">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:26px'><b>Made In</b></span>
                        <input required class="form-control" type="text"  name="made" value="" placeholder="The Country Of Made">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:36px'><b>Status</b></span>
                        <div class='form-control'>
                            <select name='status'>
                              <option value='0'>Select</option>
                              <option value='1'>New</option>
                              <option value='2'>Used</option>
                              <option value='3'>Old</option>
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:17px'><b>Members</b></span>
                        <div class='form-control'>
                              <select name='member'>
                                <?php 
                                      $users = select('*', 'users', null, null, 'user_id', 'DESC'); 
                                      foreach ($users as $user) {
                                      echo " <option value='{$user['user_id']}'>{$user['username']}</option>";
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
                        <span class="input-group-addon" style='padding-right:20px'><b>Sections</b></span>
                        <div class='form-control'>
                            <select class='select-sections' name='section'>
                              <?php 
                                    $sections = select('*', 'sections', "WHERE parent = 0");

                                    foreach ($sections as $sec) {

                                    echo " <option class='parent-option' value='{$sec['id']}'>{$sec['name']}</option>";

                                    $chlidern = select('*', 'sections', "WHERE parent = ?", $sec['id']);

                                    foreach ($chlidern as $child) {

                                       echo "<option class='child-option' value='{$child['id']}'>{$child['name']}</option>";
                                    }
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
                        <span class="input-group-addon" style='padding-right:46px'><b>Tags</b></span>
                        <input class="form-control" type="text"  name="tags" value="" placeholder="Type Tags">
                   
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



  
 <?php } elseif ($go == 'insert') { 
  global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
              
              $name        = $_POST['name'];
              $description = $_POST['description'];   
              $price       = $_POST['price'];  
              $made        = $_POST['made'];
              $status      = $_POST['status'];
              $member      = $_POST['member'];
              $section     = $_POST['section'];
              $tags        = $_POST['tags'];

              // $hashedpass = sha1($pass);
               
                $errors = [];
               // check  if this empty
              if (empty($name)) {
                 $errors [] = "name can't be blank";
               }
                if (strlen($name) < 4) {
                 $errors [] = "name can't be less than 4 char";
               } 

               if (empty($description)) {
                 $errors [] = "description can't be blank";
               }
               
               if (empty($price)) {
                  $errors [] = "price can't be blank";
                }
               if (empty($made)) {
                  $errors [] = "Made in can't be blank";
                }
                if (empty($member)) {
                  $errors [] = "You Must Choose Member";
                }

                if (empty($section)) {
                  $errors [] = "You Must Choose Section";
                }
              
                
              //        // check if item exist before.
               if (select_items_with_condition('name', 'items', $name) == 1 ) {

                 $errors[] =  "Sorry already <b>Item</b> is exist.";

               }
                      // echo errors
              foreach ($errors as $error) {

                  echo"<div class='container alert alert-danger'>".$error."</div>";

                }

             
                          // insert in database  
                if (empty($errors)){

                  $stmt = $conn->prepare("INSERT INTO 
                    items (name, description, price, country_made, status, date, sec_id, members_id, tags, approve)
                    VALUES (:zname, :zdescription, :zprice, :zmade, :zstatus, now(), :zsection, :zmember, :ztags, 0)
                ");

                  
                          // execute query
               $stmt->execute(array(
                     
                     'zname'        => $name, 
                     'zdescription' => $description,
                     'zprice'       => $price,
                     'zmade'        => $made,
                     'zstatus'      => $status, 
                     'zsection'     => $section, 
                     'zmember'      => $member,
                     'ztags'        => $tags
                ));
                   $msg = "Item <b>inserted</b> successfully";
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


 } elseif ($go == 'edit') { 

    // check if itemid in numric and exist 

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET["itemid"]) : "there is no any id like this";
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET["userid"]) : "there is no any id like this";

        $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute(array($itemid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
                  
                  // if there is user id like this show this form
         if ($stmt->rowCount() > 0) { ?>
            <div class="container">
              <div class="row"> 
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">
                    <h2 class="text-center">Edit Items</h2>

                         <!--  success message -->
                             <?php msg();?>

               <form action="?go=update" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        
                        <p><input type="hidden" value="<?php echo $itemid; ?>" name="id"></p>
                        
                        <div class="form-group">
                          <div class="cols-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon" style='padding-right:48px'><b>Name</b></span>
                              <input required class="form-control" type="text"  name="name" value="<?php echo $row['name']; old('name');?>" placeholder="Description Your Item Name">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="cols-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon" style='padding-right:9px'><b>Description</b></span>
                              <input required class="form-control" type="text"  name="description" value="<?php echo $row['description']; old('description');?>" placeholder="Description Your Item">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="cols-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon" style='padding-right:53px'><b>Price</b></span>
                              <input required class="form-control" type="text"  name="price" value="<?php echo $row['price']; old('price');?>" placeholder="Description Your Item">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="cols-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon" style='padding-right:34px'><b>Made In</b></span>
                              <input required class="form-control" type="text"  name="made" value="<?php echo $row['country_made']; old('country_made');?>" placeholder="The Country Of Made">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="cols-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon" style='padding-right:44px'><b>Status</b></span>
                              <div class='form-control'>
                                  <select name='status' value='php echo $row['status']; old('status');?>'>
                                    <option value='0' <?php if ($row['status'] == 0) { echo 'selected'; } ?> >.....</option>
                                    <option value='1' <?php if ($row['status'] == 1) { echo 'selected'; } ?> >New</option>
                                    <option value='2' <?php if ($row['status'] == 2) { echo 'selected'; } ?> >Used</option>
                                    <option value='3' <?php if ($row['status'] == 3) { echo 'selected'; } ?> >Old</option>
                                  </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="cols-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon" style='padding-right:24px'><b>Members</b></span>
                              <div class='form-control'>
                                    <select name='member'>
                                      <?php 

                                           $users = select('*', 'users', null, null, 'user_id', 'DESC'); 

                                            foreach ($users as $user) {
                                            echo " <option value='{$user['user_id']}'"; 
                                            if ($row['members_id'] == $user['user_id']) {
                                              echo 'selected'; 
                                            }
                                            echo ">{$user['username']}</option>";
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
                              <span class="input-group-addon" style='padding-right:27px'><b>Sections</b></span>
                              <div class='form-control'>
                                  <select name='section'>
                                    <?php 
                                          $get = select('*', 'sections', "WHERE parent = 0");
                            
                                          foreach ($get as $sec) {

                                          echo "<option value='{$sec['id']}'";
                                          if ($row['sec_id'] == $sec['id']) {
                                              echo 'selected'; 
                                            }
                                          echo ">{$sec['name']}</option>";

                                          $chlidern = select('*', 'sections', "WHERE parent = ?", $sec['id']);

                                          foreach ($chlidern as $child) {

                                             echo " <option class='child-option' value='{$child['id']}'>{$child['name']}</option>";
                                          }
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
                              <span class="input-group-addon" style='padding-right:53px'><b>Tags</b></span>
                              <input class="form-control" type="text"  name="tags" value="<?php echo $row['tags'];?>" placeholder="Type Tags">
                         
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


             
       <?php } else {
          echo "there is no id like this";
         }
    ?> 

 <?php
          $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET["itemid"]) : "there is no any id like this";
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET["userid"]) : "there is no any id like this";


  $rows = select("comments.*, items.name AS item_name, users.username AS username, users.user_id  AS userid", "comments",
                        "INNER JOIN items ON items.id = comments.item_id 
                         INNER JOIN users ON users.user_id = comments.user_id WHERE items.id = {$itemid}"); 

  
      if (!empty($rows)) {

  ?>

     <div class="container member-table table-responsive">
          <h2 class='text-center'>Comment <?php echo $row['name'];?> Item<br><br></h2>
          
                           <?php msg();?>

          <table class="table table-striped text-center">
            <thead>
              <tr >
                <th>#Id</th>
                <th>Comment</th>
                <th>Status</th>
                <th>ItemName</th>
                <th>UserName</th>
                <th>Register Date</th>
                <th>Control</th>
                
              </tr>
            </thead>
            <tbody>
              
               
                <?php
                  foreach ($rows as $row) {
                   echo "<tr>";

                    echo "<td>". $row['id']   . "</td>" ;
                    echo "<td>". $row['comment']  . "</td>" ;
                    echo "<td>". $row['status']     . "</td>" ;
                    echo "<td>". $row['item_name'] . "</td>" ;
                    echo "<td>". $row['username'] . "</td>" ;
                    echo "<td>". $row['date'] . "</td>" ;
                    
                     echo "<td> 
                             <a href='comments.php?go=edit&comid={$row['id']}' class='btn btn-small btn-success'><i class='fa fa-edit'></i> Edit</a>
                             <a href='comments.php?go=delete&comid={$row['id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>";
                       if ($row['status'] == 0) {
                          echo " <span class='span-right'><a href='comments.php?go=acceptPending&comid={$row["id"]}' class='btn btn-info'><i class='fa fa-check'></i> Accept</a></span>";
                        } 
                      echo "</td>";  


                   echo "</tr>";

                
                  }

                ?>

               
             

              
            </tbody>
          </table>
         
    </div>  


  <?php } // end if rows empty?>


             <!--  comment on the item -->
              <div class="row"> 
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1  col-xs-12">
                  
                  <form action="?go=insert_comment" method="POST" class="login edit_members">
                    <p><input type='hidden' name='userid' value='<?php echo $userid; ?>'>
                    <p><input type='hidden' name='itemid' value='<?php echo $itemid; ?>'>    
                    <p><label style='text-align:left; position:relative;top:-20px; 
                      left:-5px'>comment:</label><textarea  type="text" name="comment"></textarea></p>

                    <p><input class="formcontrol btn btn-primary" type="submit" name="save" value="Save"></p>
                  
                  </form>
                </div>
              </div>
            </div> 



 <?php }  elseif ($go == 'insert_comment') { 
  global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

          $comment = $_POST['comment'];
          $itemid = $_POST['itemid'];
          $userid = $_POST['userid'];



         $stmt = $conn->prepare("SELECT 
                                 comments.*,
                                 items.name  AS item_name,
                                 users.username AS username
                              FROM 
                                 comments
                              INNER JOIN
                                 items
                              ON
                                 items.id = comments.item_id
                              INNER JOIN 
                                 users
                              ON
                                 users.user_id = comments.user_id    
                              Where items.id = ? AND users.user_id = ?  
                                
                              ");

                  $stmt->execute(array($itemid, $userid));
                  $rows = $stmt->fetchAll();
                          
                 
                  $stmt = $conn->prepare("INSERT INTO  comments (comment, item_id, user_id, date) VALUES (:zcomment, :zitem, :zuser, now())
                ");

                  
                          // execute query
               $stmt->execute(array('zcomment' => $comment, 'zitem' => $item_id, 'zuser' => $user_id));

               redirect_to('back');         
              

            } else {
                  
                   redirect_to('back');
                   
              }


 } 


 elseif ($go == 'update') {
  global $conn;
            echo "<h2 class='text-center'>Update Members</h2>";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
              
              $id          = $_POST['id'] ;
              $name        = $_POST['name'];
              $description = $_POST['description'];   
              $price       = $_POST['price'];  
              $made        = $_POST['made'];
              $status      = $_POST['status'];
              $member      = $_POST['member'];
              $section     = $_POST['section'];
              $tags        = $_POST['tags'];

              // $hashedpass = sha1($pass);
               
                $errors = [];
               // check  if this empty
               if (empty($name)) {
                 $errors [] = "name can't be blank";
               } 

               if (empty($description)) {
                 $errors [] = "description can't be blank";
               }
               
               if (empty($price)) {
                  $errors [] = "price can't be blank";
                }
               if (empty($made)) {
                  $errors [] = "Made in can't be blank";
                }
                if (empty($member)) {
                  $errors [] = "You Must Choose Member";
                }

                if (empty($section)) {
                  $errors [] = "You Must Choose Section";
                }

             
                  // echo errors
              foreach ($errors as $error) {
                  echo"<div class='container alert alert-danger'>".$error."</div>";
                }


              
             if (empty($errors)) {
                   $stmt = $conn->prepare("UPDATE items SET name = ?, description = ?, price = ?, country_made = ?, status = ?, sec_id = ?,  members_id = ?, tags = ? WHERE id = ? LIMIT 1 ");

                   $stmt->execute(array($name, $description, $price, $made, $status, $section, $member, $tags , $id));  
                   
                   $msg = "Item <b>Updated</b> successfully";
                   $_SESSION['msg'] = $msg ;
                   redirect_to('back');         
              
                 } else {
                   
                   $_SESSION['error'] = $error;
                   $_SESSION['data'] = $_POST;
                   redirect_to('back');
                 }
      
  
          }


} elseif ($go == 'pending') {  

          $rows = select(" items.*, sections.name  AS section_name, users.username AS username", "items",
                           "INNER JOIN sections ON sections.id = items.sec_id
                            INNER JOIN users ON users.user_id = items.members_id
                            Where approve = 0"); 
?>

       <div class="container member-table table-responsive">
            <h2 class='text-center'>Accept New Items<br><br></h2>
            
            <?php 

              // success message
                        if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {

                            echo "<div class='alert alert-success'>{$_SESSION['msg']}</div>"; 
                            unset($_SESSION['msg']);
                         }


            ?>

        <table class="table table-striped text-center">
            <thead>
              <tr >
                <th>#Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Country Of Made</th>
                <th>Status</th>
                <th>Date</th>
                <th>Sec_ID</th> 
                <th>Member_ID</th>
                <th>Control</th>

              </tr>
            </thead>
            <tbody>
              
               
                <?php
                  foreach ($rows as $row) {
                   echo "<tr>";
  
                    echo "<td>". $row['id']             . "</td>" ;
                    echo "<td>". $row['name']           . "</td>" ;
                    echo "<td>". $row['description']    . "</td>" ;
                    echo "<td>". $row['price']          . "</td>" ;
                    echo "<td>". $row['country_made']   . "</td>" ;
                    echo "<td>". $row['status']         . "</td>" ;
                    echo "<td>". $row['date']           . "</td>" ;
                    echo "<td>". $row['section_name']   . "</td>" ;
                    echo "<td>". $row['username']       . "</td>" ;
                   

                       echo "<td> 

                               <a href='items.php?go=acceptPending&itemid={$row["id"]}' class='btn btn-info'><i class='fa fa-check'></i> Accept</a>
                               <a href='items.php?go=delete&itemid={$row['id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
                              
                            </td>" ;


                     echo "</tr>";

                  
                    }

                  ?>

              </tbody>
            </table>
            <a href='itmes.php?go=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Members</a>
      </div>




  <?php } elseif ($go == "acceptPending") {

          global $conn;

          $id   = $_GET['itemid'];

          if (!isset($_GET['id'])) {

              $stmt = $conn->prepare("UPDATE items SET approve = 1 WHERE id = ? LIMIT 1 ");

                    $stmt->execute(array($id));  
                     
                    $d = "Not Found user id";
                    $msg = "user <b>Accepted</b> successfully";
                    $_SESSION['msg'] = $msg ; 
                    $_SESSION['d'] = $d ;
                    redirect_to('back');    
                   

          }

         

  }  elseif ($go == 'delete') {  
  global $conn;

        // check if itemid in numric and exist 

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET["itemid"]) : "there is no any id like this";

        $stmt = $conn->prepare("SELECT * FROM items WHERE id = ? LIMIT 1");
        $stmt->execute(array($itemid));
        $count = $stmt->rowCount();
                  
                  // if there is user id like this show this form
         if ($stmt->rowCount() > 0) { 
               $stmt = $conn->prepare("DELETE FROM items WHERE id = ? LIMIT 1");
               $stmt->execute(array($itemid));
          
               $msg = "user <b>Deleted</b> successfully";
               $_SESSION['msg'] = $msg ;
               redirect_to('back'); 
            }

   } else {

    echo "fix your code";
  }

}

manage_items();

  ?>




<!-- include footer -->
<?php include("includes/templates/footer.php");?>