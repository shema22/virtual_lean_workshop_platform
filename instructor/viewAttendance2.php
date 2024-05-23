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
    <title>virtual lean workshop platform || View Attendance </title>
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
                            <li class="active">View Attendance</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">
                        
                    
                        <h3 class="inner-tittle two">View Attendance </h3>
                        <div class="graph">
                            <div class="tables">
                                <table class="table" border="1"> <thead> <tr> <th>#</th> 
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Created Date</th>
                                     <th>Action</th>
                                      </tr>
                                       </thead>
                                        <tbody>
                                        <?php
$user = $_SESSION['instructor'];                                        
$sql = "SELECT * FROM instructor_moules INNER JOIN modules ON instructor_moules.moduleID = modules.ModuleID WHERE instructorID = ?";
$query = $connection->prepare($sql);
$query->bind_param('i', $user);
$query->execute();
$result = $query->get_result();
$cnt = 1;
if ($result->num_rows > 0) {
    while ($row1 = $result->fetch_assoc()) {
        ?>
                                     <tr class="active">
                                      <th scope="row"><?php echo htmlentities($cnt);?></th>
                                       <td><?php  echo htmlentities($row1['Course_code']);?></td>
                                        <td><?php  echo htmlentities($row1['Course_name']);?></td>
                                        <td><?php  echo htmlentities($row1['created_at']);?></td>    
                                        <td><a href="ViewAttendance.php?editid=<?php echo $row1['moduleID'];?>">View Attendance</a></td>
                                     </tr>
                                     <?php $cnt=$cnt+1;}} ?>
                                     </tbody> </table> 
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

