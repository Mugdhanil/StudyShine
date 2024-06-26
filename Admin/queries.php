<?php 
if(!isset($_SESSION)) {
    session_start();
}
include('./adminInclude/header.php');
include_once('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];

} else {
	echo "<script> location.href= '../index.php'; </script>";
}
?>

<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class="bg-dark text-white p-2"> List of Queries/Messages </p>
    <?php
    $sql = "SELECT *FROM contact";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        echo '<table class ="table">
        <thead>
        <tr>
        <th scope = "col"> Contact ID </th>
        <th scope = "col"> Name </th>
        <th scope = "col"> Email </th>
        <th scope = "col"> Message </th>
        <th scope = "col"> Action</th>
        </tr>
        </thead>
        <tbody>';
        while($row =$result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope = "row">' .$row["id"].'</th>';
            echo '<td>' .$row["name"].'</td>';
            echo '<td>' .$row["mail"].'</td>';
            echo '<td>' .$row["message"].'</td>';
            echo '<td> <form action = "" method = "POST" class = "d-inline"> <input type = "hidden"
            name = "id" value = '.$row["id"].'> <button type = "submit" class = "btn btn-secondary" name = "delete" value= "Delete">
            <i class = "far fa-trash-alt"> </i></button>
            </form>
            </td>
            </tr>';

        }
        echo '</tbody>
        </table>';
} else {
    echo '0 Results';
}
if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM contact WHERE id = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE) {
    echo '<meta http-equiv= "refresh" content= "0;URL=?deleted" />';
    }
    else {
        echo "Unable to delete";

}
}


?>
</div>
</div>
</div>

<?php
include('./adminInclude/footer.php');
?>