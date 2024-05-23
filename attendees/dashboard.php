<?php
session_start();
include('includes/dbconnection.php');
if (!isset($_SESSION['attendee'])) {
    header("Location:index.php"); 
}
    $user = $_SESSION['attendee'];
    // Prepare the SQL query using prepared statement
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE attendeeID = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }else{

    header("index.php");
    } ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Virtual lean workshop platform||Dashboard</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/amcharts.js"></script>    
<script src="js/serial.js"></script>    
<script src="js/light.js"></script>    
<script src="js/radar.js"></script>    
<link href="css/barChart.css" rel='stylesheet' type='text/css' />
<link href="css/fabochart.css" rel='stylesheet' type='text/css' />
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
                <?php include_once('includes/header.php');?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">
                        <h3 class="inner-tittle two">Attandee's Dashboard </h3>
                        <?php
  $user=$_SESSION['attendee'] ;                                 
$sql = "SELECT * FROM attendees_modules INNER JOIN modules ON attendees_modules.moduleID = modules.moduleID WHERE attendeeID = ?";
$query = $connection->prepare($sql);
$query->bind_param('s', $user);
$query->execute();
$result = $query->get_result();

?>
<div class="row">
    <?php while ($row1 = $result->fetch_assoc()) { ?>
        <div class="col-md-4 mb-4">
        <div class="card">
    <h5 class="card-header"><?php echo htmlentities($row1['Course_name']); ?></h5>
    <div class="card-body">
        <h5 class="card-title"><?php echo htmlentities($row1['Course_code']); ?></h5>
        <div class="row">
            <!-- Button trigger modal -->
            <a href="viewAttendance.php?mod_id=<?php echo htmlentities($row1['ModuleID']); ?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#attendanceModal">
                View Attendance
            </button>
    </a>
        </div>
        

    </div>
</div>

</div>
    <?php } ?>
</div>

                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
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
