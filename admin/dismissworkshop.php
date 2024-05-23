<?php 

include('includes/dbconnection.php');// include connectivity
if (!isset($_SESSION['user'])) {
    header("Location:index.php"); 
}
    $user = $_SESSION['user'];
    // Prepare the SQL query using prepared statement
    $stmt = $connection->prepare("SELECT * FROM users WHERE usr_id = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }else{

    header("index.php");
    }
if (isset($_GET['dismiss'])) {
	//querry to delete data from table workshop
$sql = $connection->query("DELETE FROM workshop WHERE wshopID ='$_GET[dismiss]'");
if($sql){
	//leads location
		echo '<script>alert("workshop dismiss successfully.")</script>';

}else{
		echo '<script>alert("sorry somethingwent wrong!")</script>'.mysqli_error($connection);
	}
}
 ?>