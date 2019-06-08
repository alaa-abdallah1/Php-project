<?php 
// include files
     session_start();
	if (isset($_SESSION['id'])) {
	    $pagetitle = "Sections";
      include("includes.php"); 
	 } else {
           header("Location: index.php");
           exit();
	}


// start page


function manage_section(){
  global $go;
  global $secid; 
  global $conn;
  global $msg;

  $go = isset($_GET['go']) ? $_GET['go'] : "try again";
  // start manage paged

  if ($go == 'manage') { ?>

<div class="container sections">
        
  	     <h2>Manage Sections</h2>

              <!-- success message -->
                  <?php msg();?>

          <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-xs-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <i class='fa fa-edit' style='position: relative;top: 1px'></i> Manage Sections
                 
                     <div class='option'>
                       <i class='fa fa-sort'></i> Ordering:
                       <a href='sections.php?go=manage&order=ordering&sort=DESC' class='<?php if ($_GET['order'] == 'ordering' && $_GET['sort'] == 'DESC') {echo 'active';} ?>'>{ DESC </a><a>|</a>
                        <a href='sections.php?go=manage&order=ordering&sort=ASC' class='<?php if ($_GET['order'] == 'ordering' && $_GET['sort'] == 'ASC') {echo 'active';} ?>'> ASC </a> }

                      <!--   View:
                          <span class='classic' data-view="classic">Classic</span>
                          <span class='full'>Full</span> -->
                      </div>
                      <div> <i class='fa fa-sort'></i> Id:
                        <a href='sections.php?go=manage&order=id&sort=DESC' class='<?php if ($_GET['order'] == 'id' && $_GET['sort'] == 'DESC') {echo 'active';} ?>'> { DESC </a><a>|</a>
                        <a href='sections.php?go=manage&order=id&sort=ASC' class='<?php if ($_GET['order'] == 'id' && $_GET['sort'] == 'ASC') {echo 'active';} ?>'> ASC </a>}

                     </div>
                     <div>
                       
                     </div> 
                  
                </div>
                <div class="panel-body">

                          <ul> 
                            <?php                             
                                         // make odering by ordering
                        
                                $order = 'ordering';

                                $ordering_array = array("id", "ordering");

                                if (isset($_GET['order']) && in_array($_GET['order'], $ordering_array)) {

                                   $order = $_GET['order'];

                                }
                                           // make odering by ordering
                                $sort = 'ASC';

                                $sort_array = array('ASC', 'DESC');

                                if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {

                                   $sort = $_GET['sort'];

                                }
                                       


                                           
                                           //define the function for select
                                $sections = select('*', 'sections', 'WHERE parent = 0', '', $order , $sort, 100000);

                                foreach ($sections as $sec) { ?>
                                  
                                <div class='sec'>
                                  <h4>  
                                     <div class='hidden-buttons'> 
                                          <a href='sections.php?go=edit&secid=<?php echo $sec["id"]; ?>' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>
                                          <a href='sections.php?go=delete&secid=<?php echo $sec["id"]; ?>' class='btn btn-danger' id='confirm'><i class='fa fa-close'></i> Delete</a>
                                      </div>
                                      <?php echo $sec["name"]; ?>
                                  </h4>

                                
                                <div class='full-view'>
                                   <ul>
                                  <?php    
                                       // check description
                                     if (empty($sec['description'])) {
                                       echo "<li class='vis-hidden'>Description: empty</li>";
                                     } else {
                                       echo "<li class='vis-hidden'>Description: {$sec['description']}</li>";
                                     }

                                      echo "<li class='com-hidden'>Ordering: {$sec["ordering"]}</li>"; 

                                            // check visibilty
                                       if ($sec['visibelity'] == 0) {
                                         echo "<li class='vis-hidden'>Visibelity: hidden</li>";
                                       } 
                                            // check comment
                                     if ($sec['allow_comment'] == 0) {
                                         echo "<li class='com-hidden'>Comment: disabled</li>"; 
                                      } 
                                             // check ads 
                                     if ($sec['allow_ads'] == 0) {
                                         echo "<li class='ad-hidden'>ads: hidden</li>";
                                      } 


                                     // Child Sections 
                                   

                                  ?>    
                                 <!--  end full-view -->
                                  </ul>
                                </div>
                                 
                                 <?php 

                                  $child = select('*', 'sections', "WHERE parent =  ? ", $sec['id']);

                                  if (!empty($child)) {

                                      echo "<ul class='childSections'>";
                                        foreach ($child as $c) { ?>
                                           <li> <a href='sections.php?go=edit&secid=<?php echo $c["id"]; ?>' ><?php echo $c['name']; ?></a></li><br>";
                                       <?php } ?>

                                      </ul>

                                  <?php } ?>
 
                                 <!-- end sec -->
                              </div> 
                            <?php } ?>
                         </ul>
                  </div>

              </div>
              <a href='?go=add' class='btn btn-primary' style="margin:5px auto 20px; display:inline-block">Add New Sections</a>;
          </div>

       </div>
</div>




  <?php } elseif ($go == 'add') { ?> 

    <div class="container">
      <div class="row"> 
         <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">

                          <!-- Message -->
                           <?php msg();?>
            
            <h2 class="text-center">Add New Sections</h2>
            <form action="?go=insert" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:10px'><b>Section Name</b></span>
                       <input class="form-control" type="text" value='<?php old('username'); ?>' autocomplete="off" name="name" placeholder="Enter Your Section Name">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:25px'><b>Description</b></span>
                       <input class="form-control" type="text"  name="description" value="" placeholder="Description Your Section">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:43px'><b>Ordering</b></span>
                       <input  class="form-control" type="number" value='' name="ordering" placeholder="Arrange Your Section" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:19px'><b>Related With</b></span>
                        <div class='form-control'>
                         <select name='parent'>
                              <option value='0'>Main</option>
                              
                                <?php 
                                    
                                    $rows = select('*', 'sections', 'WHERE parent = 0');
                                    foreach ($rows as $row) {
                                       echo "<option value ='{$row['id']}'>{$row['name']}</option>";
                                    }
                                ?>
                              
                         </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style='position:relative'>
                    <div class="cols-sm-10">
                      <div class="input-group" style='background:#fff'>
                        <span class="input-group-addon" style='padding-right:60px'><b>Visible</b></span>

                        <div class="left-check" >
                          <input id='vis-yes'  type="radio" value='1' name="visibel" checked><label for='vis-yes'>Yes</label>  
                               
                        </div>
                        <div class="right-check">
                             <input id='vis-no' type="radio" value='0' name="visibel"><label for='vis-no'>No</label>
                        </div>
                      
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style='position:relative'>
                    <div class="cols-sm-10">
                      <div class="input-group" style='background:#fff'>
                        <span class="input-group-addon" style='padding-right:40px'><b>Comment</b></span>
                        
                        <div class="left-check" >
                         <input id='com-yes'  class="formcontrol" type="radio" value='1' name="comment" checked><label for='com-yes'>Yes</label>         
                        </div>
                        <div class="right-check">
                              <input id='com-no'  class="formcontrol" type="radio" value='0' name="comment"><label for='com-no'>No</label> 
                        </div>
                      
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style='position:relative'>
                    <div class="cols-sm-10">
                      <div class="input-group" style='background:#fff'>
                        <span class="input-group-addon" style='padding-right:37px'><b>Allow Ads</b></span>
                        
                        <div class="left-check" >
                           <input id='ad-yes'  class="formcontrol" type="radio" value='1' name="ad" checked><label for='ad-yes'>Yes</label>       
                        </div>
                        <div class="right-check">
                            <input id='ad-no'  class="formcontrol" type="radio" value='0' name="ad"> 
                            <label for='ad-no'>No</label>
                        </div>
                      
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
              $ordering    = (int) $_POST['ordering'];  
              $parent      = $_POST['parent'];  
              $visibel     = (int) $_POST['visibel'];
              $comment     = (int) $_POST['comment'];
              $ad          = (int) $_POST['ad'];


                $errors = [];
                 
                if (empty($name)) {
                 $errors [] = "name can't be blank";
               }
                
              //        // check if section exist before.
               if (select_items_with_condition('name', 'sections', $name) == 1 ) {

                 $errors[] =  "Sorry already <b>Section</b> is exist.";

               }
                      // echo errors
              foreach ($errors as $error) {

                  echo"<div class='container alert alert-danger'>".$error."</div>";

                }

             
                          // insert in database  
                if (empty($errors)){

                  $stmt = $conn->prepare("INSERT INTO 
                    sections (name, description, ordering, parent, visibelity,  allow_comment,  allow_ads)
                    VALUES (:zname, :zdescription, :zordering, :zparent, :zvisibel, :zcomment, :zad)
                ");

                  
                          // execute query
               $stmt->execute(array(
                     
                     'zname'        => $name, 
                     'zdescription' => $description,
                     'zordering'    => $ordering,
                     'zparent'      => $parent,
                     'zvisibel'     => $visibel,
                     'zcomment'     => $comment ,
                     'zad'          => $ad                 
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


 }  elseif ($go == 'edit') { 

    // check if secid in numric and exist 

        $secid = isset($_GET['secid']) && is_numeric($_GET['secid']) ? intval($_GET["secid"]) : "";
        $rows = select('*', 'sections', 'WHERE id = ?', $secid);
        foreach ($rows as $row) {
            // this loop to extract $row
         }       
                  // if there is user id like this show this form
         if (isset($row) && !empty($row)) { ?>



     <div class="container">
      <div class="row"> 
         <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2  col-xs-10 col-xs-offset-1">
          
                          <!-- Message -->
                           <?php msg();?>
            
            <h2 class="text-center">Edit Sections</h2>
            <form action="?go=update" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  
                  <p><input type="hidden" value="<?php echo $secid; ?>" name="id"></p>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:10px'><b>Section Name</b></span>
                       <input class="form-control" type="text" value='<?php echo $row['name']; ?>' autocomplete="off" name="name" placeholder="Enter Your Section Name">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:25px'><b>Description</b></span>
                       <input class="form-control" type="text"  name="description" value="<?php echo $row['description']; ?>" placeholder="Description Your Section">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:43px'><b>Ordering</b></span>
                       <input  class="form-control" type="number" value='<?php echo $row['ordering']; ?>' name="ordering" placeholder="Arrange Your Section" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="cols-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon" style='padding-right:19px'><b>Related With</b></span>
                        <div class='form-control'>
                         <select name='parent'>
                              <option value='0'>Main</option>
                              
                                 <?php 
                                  // this loop to identify who is the parent for this section
                                  $rows = select('*', 'sections', 'WHERE parent = 0');
                                  foreach ($childern as $child) {
                                     echo "<option value ='{$child['id']}'"; 
                                      
                                     echo ">".$child['name']."</option>";
                                  }
                                ?>
                              
                         </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style='position:relative'>
                    <div class="cols-sm-10">
                      <div class="input-group" style='background:#fff'>
                        <span class="input-group-addon" style='padding-right:60px'><b>Visible</b></span>

                        <div class="left-check" >
                          <input id='vis-yes'  class="formcontrol" type="radio" value='1' name="visibel" <?php if ($row['visibelity'] == 1) {echo "checked";} ?> ><label for='vis-yes'>Yes</label>  
                               
                        </div>
                        <div class="right-check">
                             <input id='vis-no'  class="formcontrol" type="radio" value='0' name="visibel" <?php if ($row['visibelity'] == 1) {echo "checked";} ?>><label for='vis-no'>No</label>
                        </div>
                      
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style='position:relative'>
                    <div class="cols-sm-10">
                      <div class="input-group" style='background:#fff'>
                        <span class="input-group-addon" style='padding-right:40px'><b>Comment</b></span>
                        
                        <div class="left-check" >
                         <input id='com-yes'  class="formcontrol" type="radio" value='1' name="comment" <?php if ($row['allow_comment'] == 1) {echo "checked";} ?> ><label for='com-yes'>Yes</label>         
                        </div>
                        <div class="right-check">
                              <input id='com-no'  class="formcontrol" type="radio" value='0' name="comment" <?php if ($row['allow_comment'] == 1) {echo "checked";} ?>><label for='com-no'>No</label> 
                        </div>
                      
                      </div>
                    </div>
                  </div>

                  <div class="form-group" style='position:relative'>
                    <div class="cols-sm-10">
                      <div class="input-group" style='background:#fff'>
                        <span class="input-group-addon" style='padding-right:37px'><b>Allow Ads</b></span>
                        
                        <div class="left-check" >
                           <input id='ad-yes'  class="formcontrol" type="radio" value='1' name="ad" <?php if ($row['allow_ads'] == 1) {echo "checked";} ?> ><label for='ad-yes'>Yes</label>       
                        </div>
                        <div class="right-check">
                            <input id='ad-no'  class="formcontrol" type="radio" value='0' name="ad" <?php if ($row['allow_ads'] == 1) {echo "checked";} ?>> 
                            <label for='ad-no'>No</label>
                        </div>
                      
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

 

       


            
       <?php } else {
          echo "there is no id like this";
         }
    ?>


<?php  } elseif ($go == 'update') {
  global $conn;
            echo "<h2 class='text-center'>Update Members</h2>";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
              
              $id          = $_POST['id'];
              $name        = $_POST['name'];
              $description = $_POST['description'];    
              $ordering    = $_POST['ordering'];  
              $parent      = $_POST['parent'];  
              $visibel     = $_POST['visibel']; 
              $comment     = $_POST['comment'];
              $ad          = $_POST['ad'];
               
              
               $errors = [];
                        
               if (empty($name)) {
                $errors [] = "name can't be blank";
               }

               $x ="AND id <> {$id}";
              if (select_items_with_condition('name', 'sections', $name, $x) == 1) {

                 $errors[] =  "Sorry already Section is exist.";

               }

             
                  // echo errors
              foreach ($errors as $error) {
                  echo"<div class='container alert alert-danger'>".$error."</div>";
                }


              
             if (empty($errors)) {
                   $stmt = $conn->prepare("UPDATE sections SET name = ?, description = ?, ordering = ?, parent = ?, visibelity = ?, allow_comment = ?, allow_ads = ? WHERE id = ? LIMIT 1 ");
                   $stmt->execute(array($name , $description, $ordering, $parent, $visibel, $comment, $ad, $id));  
                   
                   $msg = "user <b>Updated</b> successfully";
                   $_SESSION['msg'] = $msg ;
                   redirect_to('back');         
              
                 } else {
                   
                   $_SESSION['error'] = $error;
                   $_SESSION['data'] = $_POST;
                   redirect_to('back');
                 }
      
  
          }


} elseif ($go == 'delete') {  
  global $conn;

        // check if secid in numric and exist 
        $secid = isset($_GET['secid']) && is_numeric($_GET['secid']) ? intval($_GET["secid"]) : "";
        $rows = select('*', 'sections', 'WHERE id = ?', $secid, 'id', 'DESC', 1);
               
                  // if there is section id like this show this form
         if (isset($rows) && !empty($rows)) { 
               delete('sections', 'id', $secid, 'Section');
            }

   } else {
  	echo "There is no any page like this.";
  }
}

manage_section();






?>

<!-- include footer -->
<?php include("includes/templates/footer.php");?>