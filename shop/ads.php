<!-- iclude files -->
<?php 
// include files
     session_start();
  if (isset($_SESSION['user'])) {
      $pagetitle = "Create New Ad";
      include("includes.php");

   } else {
           header("Location: login.php");
           exit();
  }



?>

	 

<?php 
          /* show ads */
if ($ad = 'show') {


        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET["itemid"]) : "there is no any id like this";

        $stmt = $conn->prepare("SELECT 
                                   items.*,
                                   sections.name  AS sec_name,
                                   users.username AS username,
                                   sections.id    AS sec_Id,
                                   users.user_id  AS user_Id
        	                    FROM 
        	                       items 
        	                    INNER join
        	                        sections
        	                    ON
        	                        sections.id = items.sec_id 
        	                    INNER join
        	                        users
        	                    ON
        	                        users.user_id = items.members_id        
        	                    WHERE items.id = ?");


        $stmt->execute(array($itemid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
                  
                  // if there is user id like this show this form
         if ($stmt->rowCount() > 0) {echo '<h1>'.$row['name'].'</h1>';?>  
          
          <div class='container ad-show'>
          	<div class='row'>
          		<div class='col-sm-3 colxs-12'>
          			<img src="pic.jpg" class='img-responsive'>
          		</div>
          		<div class='col-sm-9 colxs-12 profile'>
          		  <ul>	
          			<h3><?php echo $row['name']; ?></h3>
          			<li><i class='fa fa-file fa-fw'></i>Description<span>: <?php echo $row['description']; ?></span></li>
          			<li><i class='fa fa-money fa-fw'></i>Price<span>: <?php echo $row['price']; ?></span></li>
          			<li><i class='fa fa-building fa-fw'></i>Made In<span>: <?php echo $row['country_made']; ?></span></li>
          			<li><i class='fa fa-check fa-fw'></i>Status<span>: <?php echo $row['status']; ?></span></li>
          			<li><i class='fa fa-calendar fa-fw'></i>Date<span>: <?php echo $row['date']; ?></span></li>
          			<li><i class='fa fa-tag fa-fw'></i>Category<span>: <?php echo "<a href='sections.php?pageid={$row['sec_Id']}&pagename={$row['sec_name']}'>"; echo $row['sec_name']; ?></a></span></li>
          			<li><i class='fa fa-user fa-fw'></i>Added By<span>: <?php echo $row['username']; ?></span></li>
          			<li><i class='fa fa-tags fa-fw'></i>Tags<span>:<?php 

                    $tags = explode(",", $row['tags']);
          			foreach ($tags as $tag) {
          				
          				if (!empty($tag)) {
		          				$tag = str_replace(" ", "", $tag);
		          			 	$tag = strtolower($tag);
		          			 	echo "<a href='tags.php?tag=$tag'> {$tag} </a> | ";
          				}
          			 
          			 } 


          			?></span></li>
                  </ul>
          		</div>
          	</div>



            <!--  comment on the item -->
              <?php if (isset($_SESSION['user'])) { ?>           
              <div class="row"> 
                <div class="col-sm-9 col-sm-offset-3  col-xs-12">
                  <h2>Add Your Comment</h2>
                  <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='. $_GET['itemid'];?>" method="POST" class="login edit_members">
                    <p><input type='hidden' name='userid' value='<?php echo $userid; ?>'>
                    <p><input type='hidden' name='itemid' value='<?php echo $itemid; ?>'>    
                    <p><textarea style='width:100%'  type="text" name="comment" placeholder='type your comment...'></textarea></p>
                    <p><input class="formcontrol btn btn-primary" type="submit" name="comments" value="Comment"></p>  
                  </form>
                  <?php } else {echo "<a herf='login.php'>Log In</a> or <a herf='login.php'>Register</a> To Add Comment";} ?>
                </div>
              </div> 
              
                         
  <!-- insert comment -->

                       <?php 

                           if ($_SERVER['REQUEST_METHOD'] == "POST") {
		                                if (isset($_POST['comments'])) {
		                                	
		                           $comment = FILTER_VAR($_POST['comment'], FILTER_SANITIZE_STRING);
		                           	    $userid  = $_SESSION['uid'];
		                           	    $itemid  = $_GET['itemid'];

		                           	  if (!empty($comment)) {

		                           	  	  $stmt = $conn->prepare("INSERT INTO 
		                                	                         comments (comment, user_id, item_id, status, date)
		                                	                         VALUES   (:zcomment, :zuser, :zitem, 0, now())");
		                                  $stmt->execute(array(
		                                             
		                                             'zcomment' =>  $comment,
		                                             'zuser'    =>  $userid,
		                                             'zitem'    =>  $itemid
		                                              
		                                	));
		                                   
		                           	  }
		                           }                              

                           }
                              

                       ?>   

                <hr>
              <!-- show comments --> 
               
              <?php 

                
                    $itemid = $_GET['itemid'];

                    $stmt = $conn->prepare("SELECT                                  
			                                  comments.*, 
			                                  users.username AS username                               
			        	                    FROM 
			        	                       comments
			        	                    INNER join
			        	                        users
			        	                    ON
			        	                       users.user_id = comments.user_id  
			        	                         
			        	                    WHERE comments.item_id = ?");


			        $stmt->execute(array($itemid));
			        $showComments = $stmt->fetchAll();
			        $count = $stmt->rowCount();
                    if ($count > 0) {

              ?> 
             
 <div class="row">
     	 <div class="col-sm-9 col-sm-offset-3 col-xs-12">
            <div class="panel panel-primary">
            	
			  <div class="panel-heading">Comments
                <span class='pull-right toggle-info'>
                	<i class='fa fa-plus'></i>
                </span>
			  </div>

			  <div class="panel-body show-comments" style='background:#eee'>         					    
				<!-- Media top -->
				<?php foreach ($showComments as $oneComment) { ?>  
				<div class="media">
				  <div class="media-left media-top col-sm-2 col-xs-2">
				    <img src="pic.jpg" class="media-object img-circle">
				  </div>
				  <div class="media-body">
				  	<div class="txt">
					    <h4 class="media-heading"><a href='#'><?php echo $oneComment['username']; ?></a></h4>
					    <p><?php if ($oneComment['status'] == 1) {
					    	    echo "<span class='exist-comments'>".$oneComment['comment']."</span>";} 
                                else {echo "<span class='no-comments'>Your Comment Under Activation</span>";}  ?></p>
					    <p class='date'><?php echo $oneComment['date']; ?></p>
				    </div>
				  </div>
				</div>
				<?php }?>
			  </div>
			</div>

        </div>
</div>

             

					  
					</div>
                  </div>
              </div> 

          </div>


        <?php } else {
        	echo "<div class='container alert alert-info'>there is no any comments to show</div>";
        }

           }

}

?>


<?php 


  $ad = isset($_GET['ad']) ? $_GET['ad'] : "try again";
  // start manage paged

    if ($ad == 'add') { ?>

			 <div class='container'>
				<di class='row'>

					<h1>Add new ad</h1>
			                 
			                 <!-- Ads  form -->
			        <div class="panels ads">
			     	 <div class="col-sm-12 col-xs-12">
			            <div class="panel panel-primary">
			            	
						  <div class="panel-heading"> Ads
			                <span class='pull-right toggle-info'>
			                	<i class='fa fa-plus'></i>
			                </span>
						  </div>

						  <div class="panel-body">

						  	 <div class="main-login main-center col-sm-7">
								<form class="form-horizontal" action="ads.php?ad=insert" method="POST">
									
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon" style='padding-right:29px'><b>Ad Name</b></span>
												<input type="text" class="form-control live" data-class='.live-name' name="name" id="name"  placeholder="Enter Product's Name"  maxlength="15"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"><b>Description</b></span>
												<input type="text" class="form-control live" data-class='.live-desc' name="description" id="email"  placeholder="Describe Your Products"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon" style='padding-right:55px'><b>Price</b></span>
												<input type="number" class="form-control live" data-class='.live-price' name="price" id="username"  placeholder=" The Price"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon" style='padding-right:36px'><b>Country</b></span>
												<input type="text" class="form-control" name="country" id="password"  placeholder="Country of Made"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon" style='padding-right:48px'><b>status</b></span>
												<select name='status' class="form-control">
							                        <option value=''>Select Status</option>
							                        <option value="New">New</option>
							                        <option value='Used'>Used</option>
							                        <option value='Old'>Old</option>
						                        </select>
											</div>
										</div>
									</div>

			                        <div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												 <span class="input-group-addon" style='padding-right:30px'><b>Category</b></span>
											     <select name='section' class="form-control">
							                        <?php 
							                              $stmt2 = $conn->prepare("SELECT * FROM sections");
							                              $stmt2->execute();
							                              $get = $stmt2->fetchAll();
							                              foreach ($get as $user) {
							                              echo " <option value='{$user['id']}'>{$user['name']}</option>";
							                            }
							                        ?>
							                     </select>  
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon" style='padding-right:55px'><b>Tage</b></span>
												<input type="text" class="form-control live" data-class='.live-tage' name="tags" placeholder="Type Your Tage Here."/>
											</div>
										</div>
									</div>
									<div class="form-group ">
										<button type="submit" name='submit' class="btn btn-primary btn-lg btn-block login-button" style='padding-right:'>Add Your Ad</button>
									</div>
									
								</form>
							</div> 

							          <!-- right ad -->
							<div class='col-md-5 col-sm-5 item-box'>
			                  <div class='main thumnail'>
			                  	 <p class='show-price'>$<span class='live-price' ></span></p>
			                     <img src='pic.jpg' class='img-responsive'>
			                     <div class='txt'>
			                        <h2 class='live-name'></h2>
			                        <p class='live-desc'></p>
			                        <p class='live-date'><?php echo date("Y-m-d h:i:sa"); ?></p>
			                     </div>
			                  </div>

			                  <?php 
                                                  //success message 
			                     if (!empty($_SESSION['msg'])  && isset($_SESSION['msg'])) { echo $_SESSION['msg'];unset($_SESSION['msg']); };

                                                    // error message
			                     if (!empty($_SESSION['error']) && isset($_SESSION['error'])) {  

			                     	 echo "<ul>";
			                     	   foreach ($_SESSION['error'] as $x) {
                                           echo  '<li class="alert alert-danger">'.$x.'</li>';
			                     	       unset($_SESSION['error']);
			                     	   }
			                     	       
						              echo "</ul>";
						           }
									 ?>

			                </div>       
			           

						  </div>
						</div>

			        </div>

			  
			               




				</div>
			</div>


<?php } elseif ($ad = 'insert') {

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $name        = filter_var($_POST['name']       , FILTER_SANITIZE_STRING);
		$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
		$price       = filter_var($_POST['price']      , FILTER_SANITIZE_NUMBER_INT);
		$country     = filter_var($_POST['country']    , FILTER_SANITIZE_STRING);
		$status      = filter_var($_POST['status']     , FILTER_SANITIZE_STRING);
		$section     = filter_var($_POST['section']    , FILTER_SANITIZE_NUMBER_INT);
		$tags        = filter_var($_POST['tags']    , FILTER_SANITIZE_NUMBER_INT);

    
		$errors = [];

                      // check username
			if (empty($name)) {

                    $errors [] = "Name can't be empty";
                 }
                   
				if (strlen($name) < 4 && strlen($name) > 15) {
					 $errors[] = 'Name Must Be More Than 4 and less then Carcters';
				} 
                if (strlen($description) < 10) {
					 $errors[] = 'Description Must Be More Than 10 Carcters';
				} 

				if (empty($description)) {
					 $errors[] = 'description can\'t be empty';
				} 

				if (empty($price)) {
					 $errors[] = 'price can\'t be empty';
				} 

				if (empty($country)) {
					 $errors[] = 'price can\'t be empty';
				} 
                if (empty($status)) {
					 $errors[] = 'status can\'t be empty';
				} 

				if (strlen($country) < 2) {
					 $errors[] = 'Country Must Be More Than 2 Carcters';
				} 


			

			 if (!empty($errors) && isset($_POST['submit'])) {

                 	  echo "<ul>";
		                   foreach ($errors as $error) {
		                     
		                     echo  '<li class="alert alert-danger">'.$error.'</li>';
		                     
		                 } 
                   echo "</ul>";
                 }




                   // insert in database  
                if (empty($errors) && isset($_POST['submit'])){
                  
                  $stmt = $conn->prepare("INSERT INTO 
                    items (name, description, price, country_made, status, date, sec_id, members_id, approve)
                    VALUES (:zname, :zdescription, :zprice, :zmade, :zstatus, now(), :zsection, :zmember, 0)
                ");

                  
                          // execute query
               $stmt->execute(array(
                     
                     'zname'        => $name, 
                     'zdescription' => $description,
                     'zprice'       => $price,
                     'zmade'        => $country,
                     'zstatus'      => $status, 
                     'zsection'     => $section, 
                     'zmember'      => $_SESSION['uid']
                ));

                   $_SESSION['msg'] = "<div class='alert alert-success'>Your Ad <b>Added</b> successfully";     
                   redirect_to('back');  
                } else {
                	$_SESSION['error'] = $errors;
                	redirect_to('back');
                }

   } 
     
}  else { redirect_to_main_page("index.php");} ?>






<!-- include footer -->
<?php include("../admin/includes/templates/footer.php");?>







           