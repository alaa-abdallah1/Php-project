<?php
 session_start();
 $pagetitle = "Log In";
 $navbar = "nothing";
 include("includes.php");
?>


<?php

// check if the user comes from the post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$username   = $_POST["username"];
		$password   = $_POST["password"];
		$hashedpass = sha1($password);

		//check if user exist in database or no

	    $stmt  = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ? OR password = ? AND group_id = 1 LIMIT 1");
		$stmt->execute(array($username, $hashedpass));
		$row   = $stmt->fetch();
        $count = $stmt->rowCount();

         if ($count > 0) {
			$_SESSION['id'] = $row['user_id']; // Register Session ID
			header("Location: main.php?go=main"); // Redirect To Dashboard Page
			
		} else {
			header("Location: index.php");
			exit();
		}

}

?>

<div class="container">
	<div class="row"> 
		<div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4  col-xs-8 col-xs-offset-2">
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="login">
				<h2 class="text-center">Admin Log In</h2>
				<p><input class="formcontrol" type="text" name="username" value="" placeholder="Enter Your UserName"></p>
				<p><input class="formcontrol" type="password" name="password" value="" placeholder="Enter Your Password"></p>
				<p><input class="formcontrol btn btn-primary btn-block" type="submit" name="submit" value="Log In"></p>
			</form>
		</div>
	</div>
</div>



	
<!-- include footer -->
<?php include("includes/templates/footer.php");?>