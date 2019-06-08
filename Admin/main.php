<!-- iclude files -->
<?php 
// include files
     session_start();
	if (isset($_SESSION['id'])) {
	    $pagetitle = "Edit Profile";
        include("includes.php");
	 } else {
           header("Location: index.php");
           exit();
	}
?>




<?php

	//start page
  function Main_Page(){

	  global $go;
	  global $userid; 
	  global $conn;
	  global $msg;
	  global $row;

	  $go = isset($_GET['go']) ? $_GET['go'] : "try again";


	   if ($go == 'main') { ?>
                         
			<div class="container main-page">

				<div class="row">
					<h2>DashBoard</h2>

			        <a href="members.php?go=members">
						<div class="col-sm-3 col-xs-12">
							<div class='stat' style="background:#1b5e20">
							   <div class='icon'><i class='fa fa-user'></i></div>	
				               <div class='info'>
				                 <h3>Total Members</h3>
				                 <p><?php echo count_items('user_id'); ?></p>
							   </div>
						   </div>

				         </div>
				     </a> 
				     <a href="main.php?go=pending">	   
				         <div class="col-sm-3 col-xs-12">
					         	<div class='stat' style="background:#e65100">
					         		 <div class='icon'><i class='fa fa-user-plus'></i></div>	
				                     <div class='info'>
						               <h3>Pending Members</h3>
						               <p><?php echo count_items('reg_status', 'users', 'WHERE reg_status = 0'); ?></p>
							    	</div>
							   </div>
				         </div>
			         </a>
			         <a href="items.php?go=manage">
				         <div class="col-sm-3 col-xs-12">
							<div class='stat' style="background:#212121 ">
							  <div class='icon'><i class='fa fa-tag'></i></div>	
				              <div class='info'>
				              	  <h3>Exist Items</h3>
				                  <p><?php echo  count_items('approve', 'items', 'WHERE approve = 1'); ?></p>
				              </div>
							</div>
				         </div>
			         </a>
			         <a href="items.php?go=pending">
				         <div class="col-sm-3 col-xs-12">
							<div class='stat' style="background:#01579b">
							   <div class='icon'><i class='fa fa-comment'></i></div>	
				               <div class='info'>	
				                 <h3>Pending Items</h3>
				                 <p><?php echo count_items('approve', 'items', 'WHERE approve = 0'); ?></p>
							   </div>
						    </div>
				         </div>
			         </a>
			     </div>

			     <div class="row panels">
			     	 <div class="col-sm-6 col-xs-12">
			            <div class="panel panel-primary">
						  <div class="panel-heading">
						  	Lastest <?php  $num = 5; echo $num; ?> Members Registered
			                <span class='pull-right toggle-info'>
			                	<i class='fa fa-plus'></i>
			                </span>
						  </div>
						  <div class="panel-body">
			                    <ul> 
				                    <?php
			                        
				                        $lastest = get_members_or_sections('*', 'users', 'user_id', "DESC", $num);

				                        foreach ($lastest as $item) {
				                        	
				                        	echo "<li>";

				                        	echo "<span>{$item["username"]}</span>";


			                                if ($item['reg_status'] == 0) {
			                                       echo "<span class='span-right'><a href='members.php?go=acceptPending&userid={$item["user_id"]}' class='btn btn-info'><i class='fa fa-accept'></i> Accept</a>
				                                       <a href='members.php?go=delete&userid={$item['user_id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a></span>";
			                                  }  
				                        	
			                                if ($item['reg_status'] == 1) {
			                                       echo "<span class='span-right'><a href='members.php?go=edit&userid={$item['user_id']}' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>";
				                                       
			                                  }  
				                        	

			                                echo "</li>";
				                        }
				                      
				                    ?>
			                   </ul>
						  </div>
						</div>
			        </div>
			       <div class="col-sm-6 col-xs-12">
			            <div class="panel panel-primary">
						  <div class="panel-heading">
						  	Lastest <?php  $num = 5; echo $num; ?> Items Added
			                <span class='pull-right toggle-info'>
			                	<i class='fa fa-plus'></i>
			                </span>
						  </div>
						  <div class="panel-body">
			                    <ul> 
				                    <?php
			             $items = select(" items.*, sections.name  AS section_name, users.username AS username, users.user_id  AS userid", "items",
			                        "INNER JOIN sections ON sections.id = items.sec_id 
			                         INNER JOIN users ON users.user_id = items.members_id", "", "id", "DESC", $num
			                         ); 
			  
				          
				                        foreach ($items as $item) {
				                        	
				                        	echo "<li>";

				                        	echo "<span>{$item["name"]}</span>";


			                                if ($item['approve'] == 0) {
			                                       echo "<span class='span-right'><a href='items.php?go=acceptPending&itemid={$item["id"]}' class='btn btn-info'><i class='fa fa-check'></i> Accept</a>
				                                       <a href='items.php?go=delete&itemid={$item['id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a></span>";
			                                  }  
				                        	
			                                if ($item['approve'] == 1) {
			                                       echo "<span class='span-right'><a href='items.php?go=edit&itemid={$item['id']}&userid={$item['userid']}' class='btn btn-small btn-success'><i class='fa fa-edit'></i> Edit</a></span>";
				                                       
			                                  }  
				                        	

			                                echo "</li>";
				                        }
				                      
				                    ?>
			                   </ul>
						  </div>
						</div>
			        </div>
			    </div>
			    <!-- comments div -->


			<div class="row panels">
			     	 <div class="col-sm-6 col-xs-12">
			            <div class="panel panel-primary">
						  <div class="panel-heading">
						  	Lastest <?php  $num = 5; echo $num; ?> Comments
			                <span class='pull-right toggle-info'>
			                	<i class='fa fa-plus'></i>
			                </span>
						  </div>
						  <div class="panel-body panel-body-com">
			                    <ul> 
				                    <?php

				                        
			      $stmt = $conn->prepare("SELECT 
			                                 comments.*,
			                                 items.name     AS item_name,
			                                 users.username AS username,
			                                 users.user_id  AS userid 
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
			                              WHERE 
			                                 comments.status = 1
			                              ORDER BY 
			                                  comments.id
			                              DESC    
			                              LIMIT $num


			                             
			                                
			                              ");

			          $stmt->execute();
			          $comments = $stmt->fetchAll();
			          $count    = $stmt->rowCount();

			                       
			                       if ($count > 0) {
			                       	  	   foreach ($comments as $comment) { ?>
			                       

				                        	
				                        	  <div class='comment'>
			                                      <h4 class='name'>
			                                      	<a href="members.php?go=edit&userid=<?php echo  $comment['userid']; ?>"><?php echo $comment['username']; ?></a>
			                                      </h4>
			                                      <p class='txt'><?php echo $comment['comment']; ?></p>
			                                      <?php // buttons 
			                                              if ($comment['status'] == 0) {
				                                        echo "<span class='span-right'><a href='comments.php?go=edit&itemid={$comment['id']}' class='btn btn-info'><i class='fa fa-accept'></i> Accept</a>
					                                       <a href='members.php?go=delete&userid={$item['user_id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a></span>";
				                                      }  
					                        	
				                                      if ($comment['status'] == 1) {
				                                       echo "<span class='span-right com-btn'>
				                                               <a href='comments.php?go=edit&comid={$comment['id']}' class=''><i class='fa fa-edit'></i> Edit</a>
				                                               <a href='comments.php?go=delete&comid={$comment['id']}' class='confirm'><i class='fa fa-close'></i> Delete</a>
				                                             </span>";
					                                       
				                                      } 
			                                           
			                                      ?>
				                        	  </div>
				                        	
			   
					                          <?php  
			                              // end foreach
			                                 } 
			                              // end if   
			                         } else {
				                       	 echo "<div class='alert alert-info'>There's No Any Comment To Show It</div>";
				                       }
				                      
				                    ?>
			                   </ul>
						  </div>
						</div>
			        </div>
			      <!--  <div class="col-sm-6 col-xs-12">
			            <div class="panel panel-primary">
						  <div class="panel-heading">
						  	Lastest <?php  $num = 5; echo $num; ?> Items Added
			                <span class='pull-right toggle-info'>
			                	<i class='fa fa-plus'></i>
			                </span>
						  </div>
						  <div class="panel-body">
			                    <ul> 
				                    <?php

				                        
				                        $lastest = get_members_or_sections('*', 'items', 'id', "DESC", $num);

				                        foreach ($lastest as $item) {
				                        	
				                        	echo "<li>";

				                        	echo "<span>{$item["name"]}</span>";


			                                if ($item['approve'] == 0) {
			                                       echo "<span class='span-right'><a href='items.php?go=acceptPending&userid={$item["id"]}' class='btn btn-info'><i class='fa fa-check'></i> Accept</a>
				                                       <a href='items.php?go=delete&userid={$item['id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a></span>";
			                                  }  
				                        	
			                                if ($item['approve'] == 1) {
			                                       echo "<span class='span-right'><a href='items.php?go=edit&userid={$item['id']}' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>";
				                                       
			                                  }  
				                        	

			                                echo "</li>";
				                        }
				                      
				                    ?>
			                   </ul>
						  </div>
						</div>
			        </div> -->
			    </div>

			</div>

		</div>


  <?php } elseif ($go == 'pending') { 

	    $rows = select('*', 'users', 'WHERE reg_status = 0', '', 'user_id');

?>

	     <div class="container member-table table-responsive">
	          <h2 class='text-center'>Accept New Members<br><br></h2>
	          
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
	                <th>Username</th>
	                <th>Email</th>
	                <th>FullName</th>
	                <th>Register Date</th>
	                <th>Control</th>
	              </tr>
	            </thead>
	            <tbody>
	              
	               
	                <?php
	                  foreach ($rows as $row) {
	                   echo "<tr>";

	                    echo "<td>". $row['user_id']   . "</td>" ;
	                    echo "<td>". $row['username']  . "</td>" ;
	                    echo "<td>". $row['email']     . "</td>" ;
	                    echo "<td>". $row['full_name'] . "</td>" ;
	                    echo "<td>". $row['date']      . "</td>" ;
	                   

	                     echo "<td> 

	                             <a href='members.php?go=acceptPending&userid={$row["user_id"]}' class='btn btn-info'><i class='fa fa-accept'></i> Accept</a>
	                             <a href='members.php?go=delete&userid={$row['user_id']}' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete</a>
	                            
	                          </td>" ;


	                   echo "</tr>";

	                
	                  }

	                ?>

	            </tbody>
	          </table>
	          <a href='members.php?go=add' class='btn btn-primary'><i class='fa fa-plus'></i> Add New Members</a>
	    </div>


 <?php }

}

     // call the function
	Main_Page();
?>















	

















<!-- include footer -->
<?php include("includes/templates/footer.php");?>