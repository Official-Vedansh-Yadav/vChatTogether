<?php
// server should keep session data for AT LEAST 1 Year
ini_set('session.gc_maxlifetime', 31536000);

// each client should remember their session id for EXACTLY 1 Year
session_set_cookie_params(31536000);

// Starting the session
session_start()
?> 


<?php
	// Connecting to the database
	include "partials/_dbconnect.php";
	
	// Getting the Room Name
	$room = $_POST['room'];
	
	// Code to Get the messages of this room
	$sql = "SELECT * FROM `messages` WHERE room = '".$room."'";
	$result = mysqli_query($conn, $sql);
	
	// Fetching messages
	$html = "";
	$username = $_SESSION['username'];
	while($row = mysqli_fetch_assoc($result)){
        /*
                  if(is_numeric(strpos($row['msg'],'https://')  or is_numeric(strpos($row['msg'],'http://'))){
                       $msg = "<a href='".$row['msg']."' target='_blank'>".$row['msg']."</a>";
                  }else{
                       $msg = $row['msg'];
                  } */
                  
                  $msg = $row['msg'];
                  $id = $row['s.no.'];
		  if($row['user'] == $username){
			  $html = '<div class="container green your-message">
						  <p><b>You</b></script>
						  <p>'.$msg.'</p>
						  <span class="time-right text-light">'.$row['stime'].'</span>
                                                  <i class="time-left deleteBtn text-light material-icons" id="'.$id.'" onclick="deleteMsg(this)">delete</i>
						</div>' . $html;
		  }else{
			  $html = '<div class="container">
						  <p><b>'.$row['user'].'</b></script>
						  <p>'.$msg.'</p>
						  <span class="time-right">'.$row['stime'].'</span>
						</div>' . $html;			  
		  }
	}
	echo $html;
?>