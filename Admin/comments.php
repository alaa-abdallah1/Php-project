<?php 
// include files
     session_start();
	if (isset($_SESSION['id']) || isset($_SESSION['uid'])) {
	    $pagetitle = "Comments";
      include("includes.php");
	 } else {
           header("Location: index.php");
           exit();
	}
?>


<?php 

function manage_comments(){
  global $go;
  global $comid; 
  global $conn;
  global $msg;

  $go = isset($_GET['go']) ? $_GET['go'] : "try again";
  // start manage paged

   if ($go == 'manage') { 

      $rows = select("comments.*, items.name  AS item_name, users.username AS username", "comments",
                        "INNER JOIN items ON items.id = comments.item_id 
                         INNER JOIN users ON users.user_id = comments.user_id"); 

  ?>

     <div class="container member-table table-responsive">
          <h2 class='text-center'>Comments<br><br></h2>
          
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
                <th>Comment</th>
                <th>Status</th>
                <th>Item_ID</th>
                <th>User_ID</th>
                <th>Register Date</th>
                <th>Control</th>
                
              </tr>
            </thead>
            <tbody>
              
               
                <?php
                  foreach ($rows as $row) {
                   echo "<tr>";

                    echo "<td>". $row['id']        . "</td>" ;
                    echo "<td>". $row['comment']   . "</td>" ;
                    echo "<td>". $row['status']    . "</td>" ;
                    echo "<td>". $row['item_name'] . "</td>" ;
                    echo "<td>". $row['username']  . "</td>" ;
                    echo "<td>". $row['date']      . "</td>" ;
                    
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




 <?php } elseif ($go == 'edit') { 

    // check if comid in numric and exist 

        $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET["comid"]) : "there is no any id like this";

        $stmt = $conn->prepare("SELECT * FROM comments WHERE id = ? LIMIT 1");
        $stmt->execute(array($comid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
                  
                  // if there is user id like this show this form
         if ($stmt->rowCount() > 0) { ?>
            <div class="container">
              <div class="row"> 
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">
                  <form action="?go=update" method="POST" class="login edit_members">
                    <h2 class="text-center">Edit comments</h2>

                     <?php 

                                 // if there is any error apear it here.
                       if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {

                          echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
                          unset($_SESSION['error']);
                          
                       }
                                // success message
                      if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {

                          echo "<div class='alert alert-success'>{$_SESSION['msg']}</div>"; 
                          unset($_SESSION['msg']);
                       }

                    ?>

                    <p><input type="hidden" value="<?php echo $comid; ?>" name="id"></p>

                    <p ><label style='text-align:left; position:relative;top:-20px; 
                      left:-5px'>comment:</label><textarea  type="text" name="comment"><?php echo $row['comment']; ?></textarea></p>

                    <p><input class="formcontrol btn btn-primary" type="submit" name="save" value="Save"></p>
                  </form>
                </div>
              </div>
            </div>
             
       <?php } else {
          echo "there is no id like this";
         }
    ?>

       

<?php  } elseif ($go == 'update') {
  global $conn;
            echo "<h2 class='text-center'>Update Members</h2>";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
              
              $id   = $_POST['id'];
              $comment = $_POST['comment'];
             
                   $stmt = $conn->prepare("UPDATE comments SET comment = ? WHERE id = ? LIMIT 1 ");
                   $stmt->execute(array($comment, $id));  
                   
                   $msg = "user <b>Updated</b> successfully";
                   $_SESSION['msg'] = $msg ;
                   redirect_to('back');         
              
                
  
          }   else {
                   
                   redirect_to('back');
                 }
      


} elseif ($go == 'delete') {  
  global $conn;

        // check if comid in numric and exist 

        $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET["comid"]) : "there is no any id like this";

        $stmt = $conn->prepare("SELECT * FROM comments WHERE id = ? LIMIT 1");
        $stmt->execute(array($comid));
        $count = $stmt->rowCount();
                  
                  // if there is user id like this show this form
         if ($stmt->rowCount() > 0) { 
               $stmt = $conn->prepare("DELETE FROM comments WHERE id = ? LIMIT 1");
               $stmt->execute(array($comid));
          
               $msg = "user <b>Deleted</b> successfully";
               $_SESSION['msg'] = $msg ;
               redirect_to('back'); 
            }

   } elseif ($go == "acceptPending") {

          global $conn;

          $id   = $_GET['comid'];

          if (!isset($_GET['id'])) {

              $stmt = $conn->prepare("UPDATE comments SET status = 1 WHERE id = ? LIMIT 1 ");

                    $stmt->execute(array($id));  
                     
                    $msg = "Comment <b>Accepted</b> successfully";
                    $_SESSION['msg'] = $msg ; 
                    $_SESSION['d'] = $d ;
                    redirect_to('back');    
                   

          }

         

       } 
            else {

    echo "fix your code";
  }
}

manage_comments();








 ?>






















	
<!-- include footer -->
<?php include("includes/templates/footer.php");?>
