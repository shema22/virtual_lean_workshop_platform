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
        $mod_id = $_POST['mod_id'];
        $eid = $_GET['editid'];

        $sql = "UPDATE attendees_moules SET ModuleID=? WHERE attendeeID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $mod_id, $eid);

        if ($stmt->execute()) {
            echo '<script>alert("Course has been updated")</script>';
        } else {
            echo '<script>alert("Failed to update course. Please try again.")</script>';
        }
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform || Update Course Enrolled</title>
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
                            <li class="active">Update Enrolled Courses</li>
                        </ol>
                    </div>	
                    <!-- /Sub Heard Part -->	
                    <!-- Forms -->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Update Enrolled Courses </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post">
                                    <?php 
                                    $eid=$_GET['editid'];
                                    $sql="SELECT attendees.name, modules.Course_name FROM attendees INNER JOIN attendees_moules ON attendees.attendeeID = attendees_modules.attendeeID INNER JOIN modules ON modules.ModuleID = attendees_moules.ModuleID WHERE attendees.attendeeID=?";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("s", $eid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        while ($row1 = $result->fetch_assoc()) {
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Attendee Name</label> 
                                                <input type="text" name="name" value="<?php echo $row1['name']; ?>" class="form-control" required='true' disabled> 
                                            </div>
                                            <div class="form-group"> 
                                                <label for="exampleInputEmail1">Current Module</label> 
                                                <input type="text" name="course_name" value="<?php echo $row1['Course_name']; ?>" class="form-control" required='true' disabled> 
                                            </div>
                                        <?php }
                                    } ?>
                                    <label for="exampleInputEmail1">New Module</label>
                                    <select name="mod_id" class="form-control">
                                        <?php
                                        // Assuming $conn is your MySQLi object connected to the database
                                        $sql = "SELECT ModuleID, Course_name FROM modules";
                                        $result = $connection->query($sql);
                                        while ($row1 = $result->fetch_assoc()) {
                                            echo "<option value=\"" . $row1['ModuleID'] . "\">" . $row1['Course_name'] . "</option>";
                                        }
                                        ?>
                                    </select>

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
