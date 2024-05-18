<?php

include('./dbConnection.php');
include('./mainInclude/header.php');


?>

<div class="container-fluid bg-dark">
    <div class="row">
        <img src="./images/coursebanner.jpg" alt="courses" style="height: 550px; width:100%; object-fit:cover; box-shadow:10px;">


    </div>
</div>

<div class="container jumbotron mb-5">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="background: lightgray; margin-top:20px;">
            <h5 class="mb-3" style="font-size:20px; margin-top:20px; text-align: center;">New User !! Sign Up</h5>
            <form role="form" id="stuRegForm">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <label for="stuname" class="pl-2 font-weight-bold">Name</label>
                    <small id="statusMsg1"></small>
                    <input type="text" class="form-control" style="margin-bottom:20px;margin-top: 20px;" placeholder="Name" name="stuname" id="stuname">
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <label for="stuemail" class="pl-2 font-weight-bold">Email</label>
                    <small id="statusMsg2"></small>
                    <input type="email" class="form-control" style="margin-bottom:20px;margin-top: 20px;" placeholder="Email" name="stuemail" id="stuemail">
                    <small class="form-text"> We'll never share your email </small>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <label for="stupass" class="pl-2 font-weight-bold"> New Password</label>
                    <small id="statusMsg3"></small>
                    <input type="password" class="form-control" style="margin-bottom:20px;margin-top: 20px;" placeholder="Password" name="stupass" id="stupass">
                </div>

                <button type="button" style="width: 40%;border-radius: 25px; " class="btn btn-primary" id="signup" onclick="addStu()">Sign Up</button>
               <br>  <br>
                <button type="button" style="width: 40%;border-radius: 25px; margin-right: 10px;" class="btn btn-secondary" onclick="redirectToSignIn()">Sign In</button>
                <small class="form-text margin-right: 10px;"> Already have an Account? </small>
            </form><br />
            <small id="successMsg"></small>
        </div>
    </div>
</div>

<script>
    function redirectToSignIn() {
        window.location.href = './loginorsignup2.php'; // Assuming the Sign In page is signin.php
    }
</script>


<?php
include('./mainInclude/footer.php');
?>
