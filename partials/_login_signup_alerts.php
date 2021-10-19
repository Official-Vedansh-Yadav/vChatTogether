<?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['username']) && isset($_POST['email'])) {
                if ($username == "" && $email == "" && $password == "" && $confirm_Password == "") {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>ERROR! - </strong>Please Fill all Entries
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else if(strlen($password) < 6){
					echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>ERROR! - </strong> Choose a Password of minimum 6 characters
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
				}
                else if ($password != $confirm_Password) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>ERROR! - </strong>PASSWORDS DOES NOT MATCH
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
                else if ($exist){
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>SORRY! - </strong>USERNAME OR E-MAIL ALREADY EXIST
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
                else if ($signup_result){
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success! - </strong>You Signned-Up Successfully to our Website and can Login now
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }
            
            if (isset($_POST['logemail']) && isset($_POST['logpassword'])) {
                 if ($email == "" && $password == "") {
                   echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong>ERROR! - </strong>Please Fill all Entries
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                }else{
                        if (!$exist) {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>FAILED! - </strong>NO SUCH ACCOUNT EXIST OR PASSWORD IS WRONG IF YOU NOT HAVE A ACCOUNT SIGNUP TO OUR WEBSITE
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }else if (!$password_match){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>ERROR! - </strong>INVALID PASSOWRD PLEASE WRITE CORRECT PASSWORD TO LOGIN
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                        if ($login) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success! - </strong>You is Loggedin Successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                }
            }
        }
    ?>