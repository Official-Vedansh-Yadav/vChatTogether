<?php 
  echo '<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Chat Together</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="/index.php">Home</a>
    <a class="p-2 text-dark" href="/about.php">About</a>
    <a class="p-2 text-dark" href="/contact.php">Contact</a>
  </nav>' ?>
  <?php 
  if(isset($_SESSION['loggedin'])){
        echo "<p CLASS='mr-2 my-1 text-light text-uppercase'><span class='text-danger'>Welcome</span> - <u class='text-dark'>@" . $_SESSION['username'] . "</u></p>";
        echo "<a href='/logout.php' class='btn btn-danger mx-2'>Logout</a>";
    }else{
        echo "<div>
        <button class='btn btn-danger mx-2' data-bs-toggle='modal' data-bs-target='#loginmodal'>Login</button>
        <button class='btn btn-danger mr-2' data-bs-toggle='modal' data-bs-target='#signupmodal'>Signup</button> 
        </div>";
   } ?>
<?php echo '</div>';?>

<?php include "partials/_login_signup_modals.php" ?>