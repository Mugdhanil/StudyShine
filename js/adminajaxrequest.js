// AJAX Call for admin verification
function checkAdminLogin() {
    var adminLogEmail = $("#adminLogemail").val();
    var adminLogPass = $("#adminLogpass").val();

    $.ajax({
        url: "Admin/admin.php",
        method: "POST",
        data: {
            checkLogemail: "checkLogemail",
            adminLogEmail: adminLogEmail,
            adminLogPass: adminLogPass,
        },
        success: function(data) {
            if (data == 0) {
                $('#statusAdminLogMsg').html('<small class="alert alert-danger">Invalid Email Id or Password</small>');
            } else if (data == 1) {
                $('#statusAdminLogMsg').html('<small class="alert alert-success">Success. Welcome Admin.</small>');
                setTimeout(() => {
                    window.location.href = "Admin/admindashboard.php";
                }, 100);
            }
        },
    });
}