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
 $user = $_SESSION['user'];   
$mod_id = $_GET['editid']; 
$sql = "SELECT Course_name FROM modules WHERE ModuleID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param('i', $mod_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $module = $row['Course_name'];
} else {
    // Handle the case where no results were found
    $module = "Course not found"; // Or any other appropriate action
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform || Enrolled Attendees </title>
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
                <!-- Header -->
                <?php include_once('includes/header.php');?>
                <!-- Outer WP -->
                <div class="outter-wp">
                    <!-- Sub Heard Part -->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Enrolled Attendees</li>
                        </ol>
                    </div>
                    <!-- Graph Visual -->
                    <div class="graph-visual tables-main">
                        <h3 class="inner-tittle two">Enrolled Attendees in <?php echo $module;?></h3>
                        <div class="graph">
                            <div class="tables">
                                <table class="table" border="1">
                                    <thead>
                                        <tr>
                                            <th>#</th> 
                                            <th>Attendee Name</th>
                                            <th>Reg number</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

$sql = "SELECT * FROM attendees INNER JOIN attendees_modules INNER JOIN modules ON attendees.attendeeID = attendees_modules.attendeeID AND attendees_modules.moduleID = modules.moduleID WHERE attendees_modules.moduleID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param('i', $mod_id);
$stmt->execute();
$result = $stmt->get_result();

$cnt = 1;
if ($result->num_rows > 0) {
    while ($rows = $result->fetch_assoc()) {
?>
        <tr class="active">
            <th scope="row"><?php echo htmlentities($cnt);?></th>
            <td><?php echo htmlentities($rows['name']);?></td>
            <td><?php echo htmlentities($rows['reg_no']);?></td>
            <td><?php echo htmlentities($rows['email']);?></td> 
            <td><?php echo htmlentities($rows['phone']);?></td> 
            <td><a href="editEnrolled.php?editid=<?php echo $rows['attendeeID'];?>">Edit</a></td>
        </tr>
<?php 
        $cnt++;
    }
} ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        <?php include_once('includes/sidebar.php'); ?>
        <div class="clearfix"></div>
    </div>
    <script>
        function printTable() {
            var printContents = document.getElementById("attendanceTable").outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function() {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({ "position": "absolute" });
            } else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function() {
                    $("#menu span").css({ "position": "relative" });
                }, 400);
            }

            toggle = !toggle;
        });
    </script>
    <!--js -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>


