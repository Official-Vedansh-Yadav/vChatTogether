<?php
	// Connecting to the database
	include "partials/_dbconnect.php";
	
	// POST Parameters
	$message = $_POST['message'];
	$room = $_POST['room'];
	$user = $_POST['user'];
	
	// SQL Query to Insert message in the message table
	$sql = "INSERT INTO `messages` (`msg`, `room`, `user`, `stime`) VALUES ('".$message."', '".$room."', '".$user."', current_timestamp());";
	$result = mysqli_query($conn, $sql);
?>