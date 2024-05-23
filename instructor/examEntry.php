


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


$sql = "SELECT instructor_moules.*, modules.Course_name, modules.Course_code, COUNT(attendees_modules.attendeeID) AS enrolled_attendees
        FROM instructor_moules
        INNER JOIN modules ON instructor_moules.moduleID = modules.ModuleID
        LEFT JOIN attendees_modules ON instructor_moules.moduleID = attendees_modules.moduleID
        WHERE instructor_moules.instructorID = ?";
$query = $connection->prepare($sql);
$query->bind_param('s', $user);
$query->execute();
$results = $query->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform ||Dashboard</title>
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
          crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
          type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css'/>
    <!-- //lined-icons -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/amcharts.js"></script>
    <script src="js/serial.js"></script>
    <script src="js/light.js"></script>
    <script src="js/radar.js"></script>
    <link href="css/barChart.css" rel='stylesheet' type='text/css'/>
    <link href="css/fabochart.css" rel='stylesheet' type='text/css'/>
    <!--clock init-->
    <script src="js/css3clock.js"></script>
    <!--Easy Pie Chart-->
    <!--skycons-icons-->
    <script src="js/skycons.js"></script>

    <script src="js/jquery.easydropdown.js"></script>

    <!--//skycons-icons-->
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
                </div>
                <!--//sub-heard-part-->
                <div class="graph-visual tables-main">
                    <h3 class="inner-tittle two">Admin Dashboard</h3>
                    <div class="row">
                        <?php foreach ($results as $rows) { ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <h5 class="card-header"><?php echo htmlentities($rows['Course_name']); ?></h5>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlentities($rows['Course_code']); ?></h5>
                                        <p class="card-text"><?php echo $rows['enrolled_attendees']; ?> Enrolled
                                            attendees</p>
                                        <div class="row">
                                            <div class="col">
                                                <a href="report.php?editid=<?php echo $rows['moduleID']; ?>"
                                                   class="btn btn-info btn-block">View Report</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        <?php include_once('includes/sidebar.php'); ?>
        <div class="clearfix"></div>
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function () {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position": "absolute"});
            } else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function () {
                    $("#menu span").css({"position": "relative"});
                }, 400);
            }

            toggle = !toggle;
        });
    </script>
    <!--js -->
    <link rel="stylesheet" href="css/vroom.css">
    <script type="text/javascript" src="js/vroom.js"></script>
    <script type="text/javascript" src="js/TweenLite.min.js"></script>
    <script type="text/javascript" src="js/CSSPlugin.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
