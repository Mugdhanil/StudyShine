function addStu() {
    var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    var stuname = $("#stuname").val();
    var stuemail = $("#stuemail").val();
    var stupass = $("#stupass").val();

    if (stuname.trim() == "") {
        $('#statusMsg1').html('<small style = "color:red;"> Please Enter Your Name</small>');
        $('#stuname').focus();
        return false;
    } else if (stuemail.trim() == "") {
        $('#statusMsg2').html('<small style = "color:red;"> Please Enter Email</small>');
        $('#stuemail').focus();
        return false;
    } else if (stuemail.trim() != "" && !reg.test(stuemail)) {
        $('#statusMsg2').html('<small style = "color:red;"> Please Enter Valid Email Address e.g. example123@gmail.com</small>');
        $('#stuemail').focus();
        return false;
    } else if (stupass.trim() == "") {
        $('#statusMsg3').html('<small style = "color:red;"> Please Enter Password</small>');
        $('#stupass').focus();
        return false;
    } else {
        // Hash the password
        var hashedPass = sha256(stupass);

        $.ajax({
            url: "Student/addstudent.php",
            method: "POST",
            dataType: "json",
            data: {
                stusignup: "stusignup",
                stuname: stuname,
                stuemail: stuemail,
                stupass: hashedPass, // Send hashed password
            },
            success: function (data) {
                console.log(data);
                if (data == "OK") {
                    $('#successMsg').html("<span class = 'alert alert-success'>Registration Successfully Done</span>");
                    clearStuRegField();
                } else if (data == "Failed") {
                    $('#successMsg').html("<span class = 'alert alert-danger'>Registration Failed</span>");
                }
            }
        })
    }
}