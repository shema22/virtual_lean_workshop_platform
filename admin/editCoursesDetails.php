<?php
session_start();
include('includes/dbconnection.php');
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
  

    if (isset($_POST['submit'])) {
        $updated_by = $_SESSION['userName'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $eid = $_GET['editid'];

        $sql = "UPDATE modules SET Course_code=?, Course_name=?, updated_by=? WHERE moduleID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssi", $code, $name, $updated_by, $eid);

        if ($stmt->execute()) {
            echo '<script>alert("Course details updated successfully")</script>';
            echo "<script>window.location.href ='course-list.php'</script>"; // Redirect to course listing page
        } else {
            echo '<script>alert("Failed to update course details. Please try again.")</script>';
        }
        $stmt->close();
    }
    

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform || Update Courses</title>
    <!-- Include CSS and JavaScript files -->
    <script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar() { window.scrollTo(0,1); } 
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
    <!-- Lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <!-- /JS -->
    <script src="js/jquery-1.10.2.min.js"></script>
</head> 
<body>
    <div class="page-container">
        <!-- Content Inner -->
        <div class="left-content">
            <div class="inner-content">
                <?php include_once('includes/header.php'); ?>

                <!-- Outer WP -->
                <div class="outter-wp">
                    <!-- Sub Heard Part -->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Update Courses</li>
                        </ol>
                    </div>	
                    <!-- /Sub Heard Part -->	
                    <!-- Forms -->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Update Courses </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post"> 
                                    <?php
                                    $eid = $_GET['editid'];
                                    $sql = "SELECT * FROM modules WHERE moduleID=?";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("i", $eid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        while ($row1 = $result->fetch_assoc()) {
                                            ?>
                                            <div class="form-group">
                                <label for="exampleInputEmail1">Module code</label> 
                                <input type="text" name="code" value="<?php echo $row1['Course_code']; ?>" class="form-control" required='true'> 
                                            </div>
                                <div class="form-group"> 
                                <label for="exampleInputEmail1">Module name</label> 
                                <input type="text" name="name" value="<?php echo $row1['Course_name']; ?>" class="form-control" required='true'> 
                                            </div>
                                        <?php }
                                    } ?>
                                    <button type="submit" class="btn btn-default" name="submit" id="submit">Update</button> 
                                </form> 
                            </div>
                        </div>
                    </div> 
                    <!-- /Forms -->
                </div>
                <!-- /Outer WP -->
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>		
        <?php include_once('includes/sidebar.php'); ?>
        <div class="clearfix"></div>		
    </div>
    <!-- JavaScript scripts -->
</body>
</html>
