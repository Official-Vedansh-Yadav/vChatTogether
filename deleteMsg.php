<?php 
      
      // connecting to the database
      include "partials/_dbconnect.php";
      
      // get the serial number of the message to be deleted
      $sno = $_POST['sno'];
      
      // executing the delete query
      $sql = 'DELETE FROM `messages` WHERE `s.no.` = '. $sno;
      $result = mysqli_query($conn,$sql);
?>       