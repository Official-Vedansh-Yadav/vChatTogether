<?php
// server should keep session data for AT LEAST 1 Year
ini_set('session.gc_maxlifetime', 31536000);

// each client should remember their session id for EXACTLY 1 Year
session_set_cookie_params(31536000);

// Starting the session
session_start();

// Redirecting user to the Home Page if He/She is not loggedin 
if(!(isset($_SESSION['loggedin']))){
			$message = "You is not Logged in go to the home page and login to chat If you not have any account First, Signup to your website and than login";
		echo "<script type='text/javascript'>alert('". $message ."');
		window.location = 'http://localhost/chatroom';
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
    <title>Chat Room - <?php echo $_GET['roomname'];?></title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/product/">
<!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<!-- This is the cdn for the emojionepicker Library css file copied from this link :- https://cdnjs.com/libraries/emojionearea --> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css" integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">

<!-- CSS Code for the styling of Chats || Credit :- https://www.w3schools.com/howto/howto_css_chat.asp-->
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
}

@media (min-width: 768px) {
	.bd-placeholder-img-lg {
	  font-size: 3.5rem;
	}
}

.jumbotron{
	overflow: scroll;
	height : 60vh;
	padding-top : 15px !important;
}

.green{
    background : #00b894 !important;
}

.deleteBtn{
    /* display : none; */ 
    cursor : pointer;
}

/* .your-message:hover .deleteBtn{
    display : inline;
} */

.emojionearea {
    max-height: 38px !important;
    
}

.emojionearea-editor{
    height: 0px !important;
}
</style>

  </head>
  <body>

<?php include "partials/_navbar.php"; ?>
<?php include "partials/_dbconnect.php"; ?>

<?php 
	$room = $_GET['roomname'];
	
	$existsql = "SELECT * FROM `rooms` WHERE roomname='".$room."'";
	$existresult = mysqli_query($conn,$existsql);

// This code will run only when the SQL Query will run
if($existresult){
	// What to do if any room with this name exist
	if(mysqli_num_rows($existresult) > 0){
			$username = $_SESSION['username'];
			$sql = "SELECT * FROM `users988` WHERE `UserName`='$username'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			// What to do if user not joined any room
			if($row['rooms'] == ""){
				echo '<script>window.location="http://localhost/chatroom/join.php?roomname='.$room.'";</script>';
			}
			// If user joined some rooms
			else{
				$rooms = explode(",",$row['rooms']);
				$joined = false;
				// Checking whether user joined this room or not
				foreach($rooms as $roomname){
					if($room == $roomname){
						$joined = true;
					}
				}
				// If user not joined this room
				if(!$joined){
					echo '<script>window.location="http://localhost/chatroom/join.php?roomname='.$room.'";</script>';
				}				
			}
	}
	// If No Room with this exist
	else{
		$message = "This Room Does Not Exist If You want to create a Room with this Name just apply this name and click on create room button in home page";
		echo "<script type='text/javascript'>alert('". $message ."');
		window.location = 'http://localhost/chatroom';
		</script>";
	}	
}
?>
<div class="p-5 mb-4 bg-light rounded-3 jumbotron">
        <div class="container-fluid"> 
			<h2>Chat Messages</h2>
			<div class='msgContainer'>
			</div>
      </div>
</div>

<div class='d-flex' style='position : absolute; bottom : 5px; left : 10px; right : 10px;'>
	   <textarea style='height: 38px !important; resize : none;' type='text' class='form-control' name='message' id='message' placeholder='Type your Message'></textarea>
	   <button id='sendBtn' class='btn btn-outline-success mx-2'>SEND</button>
</div>
<!-- <button id='disableScroll' class='btn btn-danger mx-2' onclick='disableAutoScroll()' style="position : absolute; top: 10px; left: 10px;">Disable Auto Scroll</button> -->
				   
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- This is the cdn for the emojionepicker Library Js file copied from this link :- https://cdnjs.com/libraries/emojionearea --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.js" integrity="sha512-aGWPnmdBhJ0leVHhQaRASgb0InV/Z2BWsscdj1Vwt29Oic91wECPixuXsWESpFfCcYPLfOlBZzN2nqQdMxlGTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script>
// using emojionepicker javascript function to add emoji picker button to the textarea
$("#message").emojioneArea({
    pickerPosition : "top"
  });
</script> -->

<script>
// Taking the HTML Code showing all messages from html_content.php file
setInterval(showMessages,1000);
function showMessages(){
  $.post("html_content.php", {room : "<?php echo $_GET['roomname']?>"} ,function(data, status){
     document.getElementsByClassName("msgContainer")[0].innerHTML = data;
  });
	// var disableBtn = document.getElementById("disableScroll");
	// if(disableBtn.innerHTML != "Able Auto Scroll"){
		// $(".jumbotron").scrollTop($(".jumbotron")[0].scrollHeight)
	// }
}

// Trigger Submit button on ctrl+enter | credit :- https://stackoverflow.com/questions/1684196/ctrlenter-jquery-in-textarea
$('#message').keydown(function (e) {
  if (e.ctrlKey && e.keyCode == 13) {
    // Ctrl-Enter pressed
	$("#sendBtn").click();
  }
});

// Send Message to the post.php file which insert it to the database
$("#sendBtn").click(function(){
  var text = $("#message").val();
	  if(text != ""){
		  $.post("post.php", {message : text, room : "<?php echo $_GET['roomname']?>", user : "<?php echo $_SESSION['username']?>"} ,function(data, status){
			 document.getElementsByClassName("msgContainer")[0].innerHTML = data;
		  });
		  $("#message").val("");
		  // Scrolling if user does not disabled Auto Scroll
			//var disableBtn = document.getElementById("disableScroll");
			//if(disableBtn.innerHTML != "Able Auto Scroll"){
			//	$(".jumbotron").scrollTop($(".jumbotron")[0].scrollHeight)
		//	}
	  }
});

// Delete an Message on clicking on delete btn
function deleteMsg(element){
        var id = element.id;
           $.post("deleteMsg.php", {sno : id, user : "<?php echo $_SESSION['username']?>"} ,function(data, status){
                                 console.log(status);
                          });
}

// Function to disable AutoScroll 
/* function disableAutoScroll(){
	var disableBtn = document.getElementById("disableScroll");
	if(disableBtn.innerHTML == "Disable Auto Scroll"){
		disableBtn.innerHTML = "Able Auto Scroll";
		//setInterval(autoScroll(false),1000);
	}else{
		disableBtn.innerHTML = "Disable Auto Scroll";
		//setInterval(autoScroll(true),1000);
	}
} */

/* Function perform autoScroll
function autoScroll(bool){
	if(bool != false){
		$(".jumbotron").scrollTop($(".jumbotron")[0].scrollHeight);
	}
}*/
</script>
</body>
</html>