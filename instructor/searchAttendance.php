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
    <title>virtual lean workshop platform || Search Invoice </title>
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
                <?php include_once('includes/header.php');?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Search Attendance</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">
                        
                    
                        <h3 class="inner-tittle two">Search Attendance by Date </h3>
                        <div class="graph">

                            <div class="tables">
                                <form method="post" name="search" action="">
  
<div class="form-group"> <label for="exampleInputEmail1">Select Course</label>
<?php
$user = $_SESSION['instructor'];
$sql = "SELECT * FROM modules LEFT JOIN instructor_moules ON modules.moduleID= instructor_moules.moduleID INNER JOIN instructor ON instructor_moules.instructorID = instructor.instructorID WHERE instructor.instructorID = ?";
$query = $connection->prepare($sql);
$query->bind_param('s', $user);
$query->execute();
$result = $query->get_result();
?>
<select name="module" id="" class="form-control">
<?php
    // Loop through the results fetched by the prepared statement
    while ($row1 = $result->fetch_assoc()) {
        echo "<option value=\"" . $row1['ModuleID'] . "\">" . $row1['Course_name'] . "</option>";
    }
?>
</select>
<div class="form-group"> <label for="exampleInputEmail1">From</label> <input id="searchdata" type="date" name="date1" class="form-control">
<br>
<div class="form-group"> <label for="exampleInputEmail1">To</label> <input id="searchdata" type="date" name="date2" class="form-control">
                        
                            <br>
                              <button type="submit" name="search" class="btn btn-primary btn-sm">Search</button> </form> 
                        </div>
</form>
<?php
if(isset($_POST['search']))
{ 
    $date1 = $_POST['date1'];                                        
    $date2 = $_POST['date2'];  
    $module = $_POST['module'];                                
    $sql = "SELECT DISTINCT datec FROM attendees_attendance WHERE datec BETWEEN ? AND ?";
    $query = $connection->prepare($sql);
    $query->bind_param('ss', $date1, $date2);
    $query->execute();
    $result = $query->get_result();
    $cnt = 1;
    if($result->num_rows > 0)
    {
        while($rows = $result->fetch_assoc())
        {               
?>
        <h4 align="center">Attendances made between "<?php echo $date1;?>" AND "<?php echo $date2;?>" </h4> 
        <a href="selectedDay.php?moduleID=<?php echo $module?>&datec=<?php echo htmlentities($rows['datec']);?>">
            <button><?php echo htmlentities($rows['datec']);?></button>
        </a>
<?php 
            $cnt = $cnt + 1;
        }
    }
    else
    {
        echo "No attendances made yet! Made attendances will be displayed here ..";
    } 
}
?>

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
