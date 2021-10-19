<?php 
    // Connect ro database
$server = "fdb32.awardspace.net";
$user = "3959851_chatroom";
$password = "vchat10together";
$database = "3959851_chatroom";
    $conn = mysqli_connect($server,$user,$password,$database);

    if (!$conn) {
        echo "Something went wrong";
		
    }
?>