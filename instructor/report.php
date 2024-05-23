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
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>virtual lean workshop platform || View Attendances </title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
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
                <?php include_once('includes/header.php'); ?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Attendance Report</li>
                        </ol>
                    </div>
                    <div class="graph-visual tables-main">
                        <h3 class="inner-tittle two">Exam entry </h3>
                        <div class="graph">
                            <div class="tables">
                                <table class="table" border="1" id="attendanceTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Attendee's Name</th>
                                            <th>Reg Number</th>
                                            <th>Can do exam?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$user = $_SESSION['instructor'];
$mod_id = $_GET['editid'];
$sql = "SELECT DISTINCT attendees_attendance.attendeeID, attendees.name, attendees.reg_no, 
               SUM(attendees_attendance.attendance) AS total_attendance,
               COUNT(attendees_attendance.attendance) AS total_classes
        FROM attendees_attendance 
        INNER JOIN attendees ON attendees_attendance.attendeeID = attendees.attendeeID 
        WHERE moduleID = ? AND instructorID = ?
        GROUP BY attendees_attendance.attendeeID, attendees.name, attendees.reg_no";
$query = $connection->prepare($sql);
$query->bind_param('ss', $mod_id, $user);
$query->execute();
$results = $query->get_result();
$cnt = 1;
if ($results->num_rows > 0) {
    while ($row1 = $results->fetch_assoc()) {
        // Calculate attendance percentage
        $attendance_percentage = ($row1['total_attendance'] / $row1['total_classes']) * 100;
        
        // Decide whether student can do exam based on attendance percentage
       if($attendance_percentage >=70){
        $decision = "<strong class='text-success'>Yes</strong>";
       }else{
        $decision= "<strong style='color:red;'>No</strong>";
       }


        ?>
        <tr class="active">
            <th scope="row"><?php echo htmlentities($cnt); ?></th>
            <td><?php echo htmlentities($row1['name']); ?></td>
            <td><?php echo htmlentities($row1['reg_no']); ?></td>
            <td><?php echo $decision; ?> || <a href="viewAttendanceDetails.php?moduleID=<?php echo $mod_id?>&attendeeID=<?php echo htmlentities($row1['attendeeID']);?>">More Details</a></td>
        </tr>
        <?php $cnt = $cnt + 1;
    }
} 
?>

                                    </tbody>
                                </table>        
                            </div>
                            <br>
                            <button onclick = printTable(); class="btn btn-info">PRINT</button>
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

