<!-- Start Session -->
<?php
 session_start();
 $pagetitle = "Log In";
 include("includes.php");
 ?>

 <?php

// check if the user comes from the post
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['login'])) {
			$user       = $_POST["username"];
			$password   = $_POST["password"];
			$hashedpass = sha1($password);

			//check if user exist in database or no

		    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ? OR password = ? ");
			$stmt->execute(array($user, $hashedpass));
			$row = $stmt->fetch();
	        $count = $stmt->rowCount();

	         if ($count > 0) {
				$_SESSION['user'] = $row['username']; // Register Session username
				$_SESSION['uid']  = $row['user_id']; // Register Session username
				header("Location: index.php"); // Redirect To Dashboard Page
				exit();
			}
                 
                 // sign up
		} else {

			$username    = $_POST["username"];
			$password    = $_POST["password"];
			$cpassword   = $_POST["cpassword"];
			$email       = $_POST["email"];
            			
			$errors = [];

                      // check username
			if (isset($username)) {

				$filterUser = filter_var($username, FILTER_SANITIZE_STRING);

				if (strlen($filterUser) < 4) {
					 $errors[] = 'Username Must Be More Than 4 Carcters';
				} 

				if (empty($filterUser)) {
					 $errors[] = 'Username can\'t be empty';
				} 


			}

			         // check password
			    if (isset($password) && isset($cpassword)) {
			    	 
			    	if (sha1($password) !== sha1($cpassword)) {
			    		
			    		$errors[] = "your password doesn't matching";
			    	}

			    	if (empty($password)  OR empty($cpassword) ) {

			    		$errors[] = 'you must type password';

			    	}

			    }


                          // check email
			if (isset($email)) {

				$filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

				if (filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
					 $errors[] = 'your mail invalid';
				} 

				if (empty($filterEmail)) {
					 $errors[] = 'your email can\'t be empty';
				} 


			}
                     // check if user exist before.
               if (select_items_with_condition('username', 'users', $username) == 1) {

                 $errors[] =  "Sorry already user is exist.";

               }

                    // if errors empty insert user
               if (empty($errors)) {
                  $stmt = $conn->prepare("INSERT INTO 
                    users(username, password, email, date)
                    VALUES (:zuser, :zpass, :zmail, now())
                ");
                       
                       // execute query
               $stmt->execute(array(
                     
                     'zuser' => $username, 
                     'zpass' => sha1($password),
                     'zmail' => $email              
                ));
                   $msg = "user <b>inserted</b> successfully";
                   echo "success";        
              
                 } 



		}
		

}

?>
 

<div class='text-center sign container'>
	<span class='in selecta'>Login</span> 
	<span>|</span> 
	<span class='up'>Sign Up</span>
</div>

<div class='container'>
	<div class='row'>

		<div class='col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 '>
		 
		  <!-- Log in -->
				<div class="modal-body login">
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" name='username' placeholder="Login">
								<label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
							</div>
						</div> <!-- /.form-group -->

						<div class="form-group">
							<div class="input-group">
								<input type="password" class="form-control" name='password' placeholder="Password">
								<label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
							</div> <!-- /.input-group -->
						</div> <!-- /.form-group -->

						<div class="checkbox">
							<label>
								<input type="checkbox"> Remember me
							</label>
						</div> <!-- /.checkbox -->
						<input type="submit" class="form-control btn btn-primary" name='login' value='Sign Up'>
					</form>

				</div>
		</div> <!-- End Log in -->

	
           <!-- Start Sign UP -->
		<div class='col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2'>

		  <!-- sign up -->
				<div class="modal-body signup">
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
						<div class="form-group">
							<div class="input-group">
								<input
								     type="text" 
								     class="form-control" 
								     name='username'  
								     placeholder="Enter Your Username"
								     >
								<label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
							</div>
						</div> <!-- /.form-group -->

						<div class="form-group">
							<div class="input-group">
								<input type="password" class="form-control" name='password' placeholder="Enter Complex Password">
								<label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
							</div> <!-- /.input-group -->
						</div> <!-- /.form-group -->

						<div class="form-group">
							<div class="input-group">
								<input type="password" class="form-control" name='cpassword' placeholder="Confirm Your Password">
								<label for="uPassword" class="input-group-addon glyphicon glyphicon-lock"></label>
							</div> <!-- /.input-group -->
						</div> <!-- /.form-group -->


						<div class="form-group">
							<div class="input-group">
								<input type="email" class="form-control" name='email' placeholder="Enter Your Email">
								<label for="uPassword" class="input-group-addon glyphicon glyphicon-envelope"></label>
							</div> <!-- /.input-group -->
						</div> <!-- /.form-group -->

						<input type="submit" class="form-control btn btn-success" name='signup' value='Sign Up'>
					</form>

				</div>
            
            <?php 
                 if (!empty($errors)) {

                 	  echo "<ul>";
		                   foreach ($errors as $error) {
		                     
		                     echo  '<li class="alert alert-danger">'.$error.'</li>';
		                     
		                 } 
                   echo "</ul>";
                 }
            ?>
                   
	</div>

</div> <!-- /.modal-footer -->










<!-- include footer -->
<?php include("../admin/includes/templates/footer.php");?>