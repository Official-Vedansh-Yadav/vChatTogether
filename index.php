<?php 
 include "partials/_dbconnect.php";
// server should keep session data for AT LEAST 1 Year
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 31536000);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(31536000);
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <meta name="description" content="vChatTogether - A chatting website created using php and jquery you can easily chat here with your friends by creating a chatting room here and sharing it's password and name with your friends">
    <meta name="author" content="Vedansh Yadav">
    <title>vChat Together - Stay Connected</title>
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/product/">

    

    <!-- Bootstrap core CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="datatables.min.css">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	  
	  .pricing-header {
			max-width: 700px;
		}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="product.css" rel="stylesheet">
  </head>
  <body>

<?php include "partials/_login_signup_script.php" ?>
<?php include "partials/_navbar.php"; ?>
<?php include "partials/_login_signup_alerts.php" ?>
<!-- Leave Room modal -->
         
  <div class='modal fade' id='leaveRoomModal' tabindex='-1' aria-labelledby='leaveRoomModalLabel' aria-hidden='true'>
         <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='leaveRoomModalLabel'>Leave This Room</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
      <div class="mb-3">
        <form action = "http://vchattogether.atwebpages.com/index.php" method = "post">
            <input type="text" id="leaveroomIndex" name = "leaveroomIndex" style="overflow: hidden; visibility: hidden;">
            <p>Are you sure to Leave this Room. It may contain your important chats</p>
           </div>
       </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' id = "cancel">cancel</button>
        <button type='submit' class='btn btn-primary'>Leave Room</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End of Leave Room modal -->

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light" style="height: 80vh;">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
  <?php 
    // This code allow user to join or create room only if heis logged in to our website
	// What if user logged in
	if(isset($_SESSION['loggedin'])){
    echo '<h1 class="display-4 font-weight-normal" style="z-index : 999 !important;">Enter the Room Name</h1>
	<form action="/join.php" method="get">
		<div class="input-group input-group-sm mb-3">
			  <span class="input-group-text" id="inputGroup-sizing-sm">vchattogether.com/</span>
			  <input type="text" name="roomname" id="roomname" class="form-control col-sm-4" placeholder="room name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
			  <button type="submit" id="joinroomname" class="btn btn-default btn-primary">Join Room</button>
		</div>
	</form>
	<form action="/create.php" method="get">
		<div class="input-group input-group-sm mb-3">
			  <span class="input-group-text" id="inputGroup-sizing-sm">vchattogether.com/</span>
			  <input type="text" name="room" id="room" class="form-control col-sm-4" placeholder="room name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
			  <button type="submit" id="createroomname" class="btn btn-default btn-primary">Create Room</button>
		</div>
	</form>';}
	// What if user not loggedin
	else{
	echo '<h1 class="display-4 font-weight-normal">Login to Join Room</h1>';
	echo "<button class='btn btn-danger mx-2' data-bs-toggle='modal' data-bs-target='#loginmodal'>Login</button>
    <button class='btn btn-danger mr-2' data-bs-toggle='modal' data-bs-target='#signupmodal'>Signup</button>";
	}
	?>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  </div>

	
	  <?php 
	  // Code to to show joined room only if user logged in
	  if(isset($_SESSION['loggedin'])){
		  $username = $_SESSION['username'];
		  $sql = "SELECT * FROM `users988` WHERE `UserName`='$username'";
		  $result = mysqli_query($conn,$sql);
		  $row = mysqli_fetch_assoc($result);

          // showing joined rooms in a data table
          if($row['rooms'] != ""){
                  echo '<div class="container">
                                  <h2>Rooms Joined by You</h2>
                                  <table class="table" id = "myTable">
                                                  <thead>
                                                                <tr>
                                                                  <th scope="col">s.r.</th>
                                                                  <th scope="col">Room Name</th>
                                                                  <th scope="col">Action</th>
                                                                  <th scrope="col">Action2</th>
                                                                </tr>
                                                  </thead>
                                                  <tbody>';
                        // Code to Leave Room If user used this function
                        if(isset($_POST['leaveroomIndex'])){
                                        $rooms = explode(",",$row['rooms']);
                                        $index = $_POST['leaveroomIndex'];
                                        // Adding a Message to message table telling the this user left the room
                                        $room = $rooms[$index];
                                        $text = $username . " left the room"; // This text variable tells who left the room
                                        $insertsql = "INSERT INTO `messages` (`room`, `user`, `stime`) VALUES ('".$room."', '".$text."', CURRENT_TIMESTAMP)";
                                        $insertresult = mysqli_query($conn,$insertsql);
                                        
                                        unset($rooms[$index]);
                                        $rooms = join(",",$rooms);
                                        $sql = "UPDATE `users988` SET `rooms` = '".$rooms."' WHERE `UserName` = '".$username."'";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                                $leaveroom = true;
                                        }else{
                                                $leaveroom = false;
                                        }
                                        echo "<script>window.location = 'http://vchattogether.atwebpages.com/';</script";
                        }
                        $rooms = explode(",",$row['rooms']);
                        $sno = 1;
                        $html = null;
                        for ($i = 0; $i < count($rooms); $i++){
                                $room = $rooms[$i];
                                $index = $i;
                                // Showing the Room Name Only If It is not empty
                                if($room != ""){
                                $html .= "
                                        <tr>
                                          <td scope='row'>" . $sno . "</th>
                                          <td><strong>" . $room . "</strong></td>
                                          <td><a href='/room.php?roomname=".$room."' type='button' class='btn btn-primary mx-1 edit'>Enter</a></td>
                                          <td><button class='btn btn-secondary leave' id='".$index."' data-bs-toggle='modal' data-bs-target='#leaveRoomModal'>Leave</button></td>
                                        </tr>";
                                        $sno++;
                                }
                        }
                        echo $html;
                        echo '</tbody></table></div>';
		  }
	}
	  ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="datatables.min.js"></script>

<script>
// Code for data tables 
    $(document).ready( function () {
    $('#myTable').DataTable();
     } );
	 
// Code to Make Value of LeaveRoomIndex Input equal to Room Index you want to leave
     var leaves = document.querySelectorAll(".leave");
     Array.from(leaves).forEach((element)=>{
        element.addEventListener('click', (e)=>{
          document.getElementById('leaveroomIndex').value = e.target.id;
        })
     });
	/*function leaveRoom(index){*/


</script>

<script> 
// code to auto submit room name on enter | credit :- https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
// code to auto submit room name on enter | credit :- https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
var input = document.getElementById("roomname");

input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("joinroomname").click();
  }
}); 

var input2 = document.getElementById("room");

input2.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("createroomname").click();
  }
}); 
</script>

  </body>
</html>
