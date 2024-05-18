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
            <h5 class="mb-3" style="font-size:20px; margin-top:20px;">Already have an Account? Sign In</h5>
            <form role="form" id="stuLoginForm">
                <div class="form-group">
                    <i class="fas fa-envelope"> </i>
                    <label for="stuLogemail" class="pl-2 font-weight-bold">Email</label>
                    <small id="statusLogMsg1"></small>
                    <input type="email" class="form-control" style="margin-bottom:20px;margin-top: 20px;" placeholder="Email" name="stuLogemail" id="stuLogemail">
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <label for="stuLogpass" class="pl-2 font-weight-bold">Password</label>
                    <input type="password" class="form-control" style="margin-bottom:20px;margin-top: 20px;" placeholder="Password" name="stuLogpass" id="stuLogpass">
                </div>

                <button type="button" style="width: 40%;border-radius: 25px;" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Sign In</button>
                <br> <br>              
                <button type="button" style="width: 40%;border-radius: 25px;" class="btn btn-secondary" onclick="redirectToSignUp()">Sign Up</button>
                <small class="form-text margin-right: 10px;"> New User? </small>
            </form><br>
            <small id="statusLogMsg"></small>
        </div>
    </div>
</div>

<script>
    function redirectToSignUp() {
        window.location.href = './loginorsignup.php'; // Assuming the Sign Up page is signup.php
    }
</script>


<?php
include('./mainInclude/footer.php');
?>