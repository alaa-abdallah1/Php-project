<?php 

	 require_once("includes/templates/connection.php");
	 include("includes/functions/functions.php");
	 require_once("includes/lang/english.php");
	 require_once("includes/templates/header.php");

	     /* navbar include */
     if (isset($navbar)) {
     	return "";
     } else {
     	require_once("includes/templates/navbar.php");
     }
 ?>