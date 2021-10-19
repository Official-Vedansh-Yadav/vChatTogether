<!-- signup Modal -->
<div class='modal fade' id='signupmodal' tabindex='-1' aria-labelledby='signupmodalLabel' aria-hidden='true'>
   <div class='modal-dialog'>
   <div class='modal-content'>
   <div class='modal-header'>
   <h5 class='modal-title' id='signupmodalLabel'>Signup for an vchatTogether Account</h5>
   <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
   </div>
   <div class='modal-body'>
            <div class="container mt-3">
                <form action="<?php $_SERVER['REQUEST_URI']; ?>" method = "POST" class="my-3">
                <div class="mb-3">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name = "username" aria-describedby="emailHelp" placeholder='Type any User-Name'>
                </div>
                <div class="mb-3">
                <label for="email" class="form-label">E-Mail address</label>
                <input type="email" class="form-control" id="email" name = "email" aria-describedby="emailHelp" placeholder='Type any E-Mail'>
                </div>
                <div class="mb-3 flex" style="width: 100%;">
                <label for="password" class="form-label mt-2">Password</label>
                <input type="password" class="form-control" name = "password" id="password" placeholder="Enter your Password">
                </div>
                <div class="mb-3 flex" style="width: 100%;">
                <label for="c-password" class="form-label mt-2">Confirm Password</label>
                <input type="password" class="form-control" name = "confirm-password" id="c-password" placeholder="Confirm Your password">
                </div>
                <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
   </div>
   </div>
   </div>
   </div>
</div>
<!-- signup Modal ends -->

<!-- Login Modal -->
<div class='modal fade' id='loginmodal' tabindex='-1' aria-labelledby='loginmodalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
    <div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' id='loginmodalLabel'>Login to vchatTogether</h5>
    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>
        <div class=container mt-3'>
        <form action = '<?PHP echo $_SERVER['REQUEST_URI'] ?>' method = 'POST'>
        <div class='mb-3'>
        <label for='login-email' class='form-label'>Email address</label>
        <input type='email' class='form-control' name='logemail' id='login-email'>
        <div id='emailHelp' class='form-text'>We'll never share your email with anyone else.</div>
        </div>
        <div class='mb-3'>
        <label for='login-password' class='form-label'>Password</label>
        <input type='password' class='form-control' name='logpassword' id='login-password'>
        </div>
        <button type='submit' class='btn btn-primary'>Submit</button>
        </div>
        </div>
        </form>
    </div>
    </div>
    </div>
</div>
<!-- Login Modal ends -->