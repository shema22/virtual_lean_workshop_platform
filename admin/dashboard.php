<?php
session_start();
// error_reporting(0);
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

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Virtual lean workshop platform||Dashboard</title>

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
        
            <?php include_once('includes/header.php');?>
            
            <div class="outter-wp">
                <!--custom-widgets-->
                <div class="custom-widgets">
                    <div class="row-one">
                        <div class="col-md-4 widget">
                            <div class="stats-left ">
                                <?php 
                                $sql ="SELECT attendeeID from attendees ";
                                $query = $connection -> prepare($sql);
                                $query->execute();
                                $query->store_result();
                                $tclients=$query->num_rows();
                                ?>
                                <h5>Total</h5>
                                <h4> Attendees</h4>
                            </div>
                            <div class="stats-right">
                                <label><?php echo htmlentities($tclients);?></label>
                            </div>
                            <div class="clearfix"> </div>    
                        </div>
                        <div class="col-md-4 widget states-mdl">
                            <div class="stats-left">
                            <?php 
$sql1 ="SELECT instructorID from instructor ";
$query1 = $connection -> prepare($sql1);
$query1->execute();
$query1->store_result();
$tser=$query1->num_rows();
?>  
                                <h5>Total</h5>
                                <h4>Instructors</h4>
                            </div>
                            <div class="stats-right">
                                <label> <?php echo htmlentities($tser);?></label>
                            </div>
                            <div class="clearfix"> </div>    
                        </div>
                        
                        <div class="col-md-4 widget">
                            <div class="stats-left">
                            <?php 
$sql2 ="SELECT moduleID from modules";
$query2 = $connection -> prepare($sql2);
$query2->execute();
$query2->store_result();
$tclients2=$query2->num_rows();
?>                              
                                <h5>Total</h5>
                                <h4>Modules</h4>
                            </div>
                            <div class="stats-right">
                                <label><?php echo htmlentities($tclients2);?></label>
                            </div>
                            <div class="clearfix"> </div>    
                        </div>
                        <div class="clearfix"> </div>    
                    </div>
<br>
                    <div class="col-md-4 widget">
                            <div class="stats-left">
                            <?php 
$sql4 ="SELECT wshopID from workshop";
$query4 = $connection -> prepare($sql4);
$query4->execute();
$query4->store_result();
$tclients4=$query4->num_rows();
?>                              
                                <h5>Total</h5>
                                <h4>Workshops</h4>
                            </div>
                            <div class="stats-right">
                                <label><?php echo htmlentities($tclients4);?></label>
                            </div>
                            <div class="clearfix">     
                        
                          
                    </div>                  
                </div>
                
                    <div class="col-md-4 widget states-mdl">
                            <div class="stats-left">
                            <?php 
$sql3 ="SELECT id from problem_issued";
$query3 = $connection -> prepare($sql3);
$query3->execute();
$query3->store_result();
$tclients3=$query3->num_rows();
?>                              
                                <h5>Total</h5>
                                <h4>Ploblems Issued</h4>
                            </div>
                            <div class="stats-right">
                                <label><?php echo htmlentities($tclients3);?></label>
                            </div>
                            <div class="clearfix"> </div>    
                        </div>
                        <div class="clearfix"> </div>    
                    </div>                  
                </div>
                </div>
            </div>
        </div>
        
                        </div>
                        <div class="outter-wp">
        
        <?php include_once('includes/footer.php');?>
        
    </div>
 </div>
</div>
<!--//content-inner-->

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
