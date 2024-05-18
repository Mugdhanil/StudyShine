<?php
if(!isset($_SESSION)){
	session_start();
}

include('./adminInclude/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])) {
$adminEmail = $_SESSION['adminLogEmail'];

} else {
	echo "<script> location.href= '../index.php'; </script>";
}
?>
<div class="col-sm-7 mt-5" style="
    margin-left: 35px;">
<form action="" method="POST" class="d-print-none">
<div class="form-row">
<div class="form-group col-md-2">
<input type="date" class="form-control" id="startdate" name="startdate">
</div> <span> to </span> <br>
<div class="form-group col-md-2">
<input type="date" class="form-control" id="enddate" name="enddate">
</div>
<br>
<div class="form-group">
<input type="submit" class="btn btn-secondary" name= "searchsubmit" value="Search">
</div>
</div>
</form>
<?php
if (isset($_REQUEST['searchsubmit'])){
    $startdate = $_REQUEST['startdate'];
    $enddate = $_REQUEST['enddate'];

    $sql = "SELECT *FROM payment WHERE p_date BETWEEN '$startdate' AND '$enddate'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Course ID</th>
                <th scope="col">Student Email</th>
                <th scope="col">Order Date</th>
                <th scope="col">Amount</th>
                
            </tr>
        </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
        echo '<tr>
        <th scope="row">'.$row["p_id"].'</th>
           <td>'.$row["course_id"].'</td>
            <td>'.$row["stu_email"].'</td>
            <td>'.$row["p_date"].'</td>
              <td>'.$row["course_price"].'</td>
              </tr>';
           
    }
    echo '<tr>
    <td> <form class = "d-print-none"><input class = "btn btn-danger" type= "submit" value="Print" onClick = "window.print()"></form></td>
    </table>';
    } else {
        echo "<div class = 'alert alert warning col-sm-6 ml-5 mt-2' role= 'alert'> No Records Found </div>";
    }
}
?>
</div>
</div>
</div>
<?php
include('./adminInclude/footer.php');
?>









<?php
include('./adminInclude/footer.php');
?>