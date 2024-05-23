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
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $eid = $_GET['editid'];
        $updatedBy = $name;

        $sql = "UPDATE instructor SET name=?, phone=?, email=?, updated_by=? WHERE instructorID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssss", $name, $phone, $email, $updatedBy, $eid);

        if ($stmt->execute()) {
            echo '<script>alert("instructor has been updated")</script>';
        } else {
            echo '<script>alert("Failed to update lecture. Please try again.")</script>';
        }
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform|| Update instructors</title>
    <!-- Include CSS and JavaScript files -->
    <script type="application/x-javascript">addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <!-- Graph CSS -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- jQuery -->
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
              type='text/css'>
        <!-- lined-icons -->
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css'/>
        <!-- /js -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <!-- //js-->
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
                            <li class="active">Update Instructor</li>
                        </ol>
                    </div>	
                    <!-- /Sub Heard Part -->	
                    <!-- Forms -->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Update Instructor </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post"> 
                                    <?php
                                    $eid=$_GET['editid'];
                                    $sql="SELECT * FROM instructor WHERE instructorID=?";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("s", $eid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        while ($row1 = $result->fetch_assoc()) {
                                            ?>
                                            <div class="form-group"> 
                                                <label for="exampleInputEmail1">Lecture name</label> 
                                                <input type="text" name="name" value="<?php echo $row1['name']; ?>" class="form-control" required='true'> 
                                            </div>
                                            <div class="form-group"> 
                                                <label for="exampleInputEmail1">Phone number</label> 
                                                <input type="text" name="phone" value="<?php echo $row1['phone']; ?>" class="form-control" required='true'> 
                                            </div>
                                            <div class="form-group"> 
                                                <label for="exampleInputEmail1">Email</label> 
                                                <input type="text" name="email" value="<?php echo $row1['email']; ?>" class="form-control" required='true'> 
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
