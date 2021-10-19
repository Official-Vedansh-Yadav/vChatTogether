<?php 

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // PHP LOGIC TO SIGNUP THE USER 
        if (isset($_POST['username']) && isset($_POST['email'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_Password = $_POST['confirm-password'];
            // Check exist
            $exist = false;
            $existsql = "SELECT * FROM `users988` WHERE `UserName` = '$username' AND `E-Mail` = '$email'";
            $result = mysqli_query($conn,$existsql);
            $numExistrows = mysqli_num_rows($result);
            if ($numExistrows > 0){
                $exist = true;
            }else{
                    if (($username != "" && $email != "" && $password != "" && $confirm_Password != "") && strlen($password) > 5 && $password == $confirm_Password) {
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO `users988` (`UserName`, `E-Mail`, `password`, `Signup_Date`) VALUES ('$username', '$email', '$hash', current_timestamp())";
                            $signup_result = mysqli_query($conn,$sql);
                    }
                }
        }

    // PHP LOGIC TO LOGIN THE USER 
if (isset($_POST['logemail']) && isset($_POST['logpassword'])) {
        $login = false;
        $email = $_POST['logemail'];
        $password = $_POST['logpassword'];
        if ($email != ""  && $password != ""){
                $exist = false;
                $existsql = "SELECT * FROM `users988` WHERE `E-Mail`='$email'";
                $result = mysqli_query($conn,$existsql);
                $numrowsExist = mysqli_num_rows($result);
                if ($numrowsExist > 0){
                    $exist = true;
                    $row = mysqli_fetch_assoc($result);
                        if (password_verify($password,$row['password'])){
                                $password_match = true;
                                $login = true;
                                $username = $row['UserName'];
                                $_SESSION['loggedin'] = true;
                                $_SESSION['username'] = $username;
                                $_SESSION['email'] = $email;
                        }else{
                                $password_match = false;
    }}}}}

?>