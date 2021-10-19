<?php
// server should keep session data for AT LEAST 1 Year
ini_set('session.gc_maxlifetime', 31536000);

// each client should remember their session id for EXACTLY 1 Year
session_set_cookie_params(31536000);

// Starting the session
session_start();

// Redirect user to the home page if he/she is not logged in
if(!(isset($_SESSION['loggedin']))){
			$message = "You is not Logged in go to the home page and login to chat If you not have any account First, Signup to your website and than login";
		echo "<script type='text/javascript'>alert('". $message ."');
		window.location = 'http://vchattogether.atwebpages.com/';
		</script>";
}
?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Join Room</title>

<link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/product/">
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


<!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">

  </head>
  <body>

<?php include "partials/_navbar.php"; ?>

<?php 

include "partials/_dbconnect.php";
$room = $_GET['roomname'];

$username = $_SESSION['username'];
$sql = "SELECT * FROM `users988` WHERE `UserName`='$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

// Checking whether user already joined the room if user already joined room so, he/she will directly redirect to the room.php
if($row['rooms'] != ""){
	$rooms = explode(",",$row['rooms']);
	foreach($rooms as $roomname){
		if($room == $roomname){
			echo '<script>window.location="http://vchattogether.atwebpages.com/room.php?roomname='.$room.'";</script>';
		}
	}
	goto a;
}
else{
	a :
// What if user send post request 
if(isset($_POST['password'])){
	$sql = "SELECT * FROM `rooms` WHERE roomname='".$room."'";
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_assoc($result);
	// Checking Password Match or not and If password match so this room will be added to the list of rooms joined by the user and redirecting him to room.php
	if($row['password'] == $_POST['password']){
		$username = $_SESSION['username'];
		$sql = "SELECT * FROM `users988` WHERE `UserName`='$username'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$rooms = $row['rooms'];
		$rooms .= "$room,";
		$roomNametobeInsert = $rooms;
		$sql = "UPDATE `users988` SET `rooms` = '".$roomNametobeInsert."' WHERE `UserName` = '".$username."'";
		$joinresult = mysqli_query($conn, $sql);
                // Adding a Message to message table telling the this user joined the room
                if($joinresult){
                   $text = $username . " joined the room"; // This text variable tells who joined the room
                   $insertsql = "INSERT INTO `messages` (`room`, `user`, `stime`) VALUES ('".$room."', '".$text."', CURRENT_TIMESTAMP)";
                   $insertresult = mysqli_query($conn,$insertsql);
                }
		echo '<script>window.location = "http://vchattogether.atwebpages.com/room.php?roomname='.$room.'";</script>';
		}		
	// Output If Password does not match
	else{
		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>ERROR! - </strong>Password is Wrong. Try Again with correct Password
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			 </div>";

		echo '
			<div class="container">
				<h1>Enter the Password of the Room to Join</h1>
				<form action="'.$_SERVER["REQUEST_URI"].'" method="post">
					  <div class="mb-3">
						<input placeholder="Password" id="password" type="password" name="password" class="form-control" id="exampleInputPassword1">
					  </div>
					  <button type="submit" id="joinroom" class="btn btn-primary">Submit</button>
				</form>
			</div>
		';
	}
}else{

// showing a error if length of the room name is less than 2 or greater than 20 and redirecting user to index page
if(strlen($room) < 2 or strlen($room) > 20){
	$message = "The Room Name is Invalid Choose a name between 2 to 20 letters";
	echo "<script type='text/javascript'>alert('". $message ."');
	window.location = 'http://vchattogether.atwebpages.com/';
	</script>";
}

// showing a error if room name is not AlphaNumeric and redirecting user to index page
else if(!ctype_alnum($room)){
	$message = "The Room Name is Invalid type an alpha Numeric Name (i.e. Name without any space)";
	echo "<script type='text/javascript'>alert('". $message ."');
	window.location = 'http://vchattogether.atwebpages.com/';
	</script>";
}

else{
	$sql = "SELECT * FROM `rooms` WHERE roomname='".$room."'";
	$result = mysqli_query($conn,$sql);
	
	if($result){
		// Taking the Password of the Room If a room with this name exist
		if(mysqli_num_rows($result) > 0){
			echo '
			<div class="container">
				<h1>Enter the Password of the Room to Join</h1>
				<form action="'.$_SERVER["REQUEST_URI"].'" method="post">
					  <div class="mb-3">
						<input placeholder="Password" id="password" type="password" name="password" class="form-control" id="exampleInputPassword1">
					  </div>
					  <button type="submit" id="joinroom" class="btn btn-primary">Submit</button>
				</form>
			</div>
			';
		}
		// showing a error if this room does not exist and redirecting user to index page
		else{
			$message = "This Room Does Not Exist If You want to create a Room with this Name just apply this name and click on create room button in home page";
			echo "<script type='text/javascript'>alert('". $message ."');
			window.location = 'http://vchattogether.atwebpages.com/';
			</script>";
		}
	}
}
}
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script> 
// code to auto submit room name on enter | credit :- https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
var input = document.getElementById("password");

input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("joinroom").click();
  }
}); 
</script>
</body>
</html>