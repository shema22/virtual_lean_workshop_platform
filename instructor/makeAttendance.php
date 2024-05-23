<?php
session_start();
include('includes/dbconnection.php');
if (!isset($_SESSION['instructor'])) {
    header("Location:index.php"); 
}
    $user = $_SESSION['instructor'];
    // Prepare the SQL query using prepared statement
    $stmt = $connection->prepare("SELECT * FROM instructor WHERE instructorID = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }else{

    header("index.php");
    }

if (isset($_POST['submit'])) {
    $mod_id = intval($_GET['editid']);
    $user = $_SESSION['instructor'];
    $date = date("Y-m-d");

    // Check if attendance has already been recorded for this module and date
    $sql_check = "SELECT COUNT(*) as count FROM attendees_attendance WHERE moduleID = ? AND instructorID = ? AND datec = ?";
    $stmt_check = $connection->prepare($sql_check);
    $stmt_check->bind_param("iis", $mod_id, $user, $date);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc();

    if ($row_count['count'] > 0) {
        echo '<script>alert("Attendance for this module today has already been recorded.");</script>';
    } else {
        // Proceed to insert attendance data
        // Prepare the data for insertion
        $attendanceData = array();
        $sids = isset($_POST['attendance']) ? array_keys($_POST['attendance']) : array();

        // Get all attendees under the module
        $sql_attendees = "SELECT * FROM attendees_modules INNER JOIN attendees ON attendees_modules.attendeeID = attendees.attendeeID WHERE attendees_modules.moduleID = ?";
        $stmt_attendees = $connection->prepare($sql_attendees);
        $stmt_attendees->bind_param("i", $mod_id);
        $stmt_attendees->execute();
        $result_attendees = $stmt_attendees->get_result();
        $attendees = $result_attendees->fetch_all(MYSQLI_ASSOC);

        foreach ($attendees as $attendee) {
            $attendeeID = $attendee['attendeeID'];

            // Check if the attendee has attendance data submitted
            $attendance = isset($_POST['attendance'][$attendeeID]) ? 1 : 0;

            // Prepare the attendance data
            $attendanceData[] = array(
                'moduleID' => $mod_id,
                'attendeeID' => $attendeeID,
                'instructorID' => $user,
                'attendance' => $attendance,
                'datec' => $date
            );
        }

        // Insert all the attendance records at once
        $sql = "INSERT INTO attendees_attendance (moduleID, attendeeID, instructorID, attendance, datec) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        foreach ($attendanceData as $data) {
            $stmt->bind_param("iiiss", $data['moduleID'], $data['attendeeID'], $data['instructorID'], $data['attendance'], $data['datec']);
            $stmt->execute();
        }

        echo '<script>alert("Attendance Done")</script>';
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform || Make Attendance</title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <!-- /js -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <!-- //js-->
</head> 
<body>
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="inner-content">
                <!-- header-starts -->
                <?php include_once('includes/header.php');?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Make Attendance</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">
                        <h3 class="inner-tittle two"> Make Attendance</h3>
                        <div class="graph">
                            <div class="tables">
                                <form method="post">
                                <table class="table" border="1"> 
                                    <thead> 
                                        <tr> 
                                            <th>#</th> 
                                            <th>Attendee's Name</th>
                                            <th>Reg number</th> 
                                            <th>Email</th> 
                                            <th>Phone</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $mod_id = $_GET['editid'];                                            
                                        $sql = "SELECT * from attendees_modules inner join attendees on attendees_modules.attendeeID = attendees.attendeeID where attendees_modules.moduleID = ?";
                                        $stmt = $connection->prepare($sql);
                                        $stmt->bind_param("i", $mod_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        $cnt = 1;
                                        while ($row1 = $result->fetch_assoc()) {
                                        ?>
                                        <tr class="active">
                                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                                            <td><?php  echo htmlentities($row1['name']);?></td>
                                            <td><?php  echo htmlentities($row1['reg_no']);?></td>
                                            <td><?php  echo htmlentities($row['email']);?></td>
                                            <td><?php  echo htmlentities($row1['phone']);?></td>

            <td><input type="checkbox" name="attendance[<?php echo $row1['attendeeID']; ?>]" value="1">
            </td>
         </tr>
     <?php $cnt = $cnt + 1;
} ?>
<tr>
<td colspan="6" align="center">
<button type="submit" name="submit" class="btn btn-default">Submit</button>        
</td>

</tr>
                                         </tbody> </table> 
                                         </form>
                            </div>

                        </div>
                
                    </div>
                    <!--//graph-visual-->
                </div>
                <!--//outer-wp-->
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
        <!--//content-inner-->
        <!--/sidebar-menu-->
        <?php include_once('includes/sidebar.php');?>
        <div class="clearfix"></div>        
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function() {                
            if (toggle)
            {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position":"absolute"});
            }
            else
            {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function() {
                    $("#menu span").css({"position":"relative"});
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
