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
} else {
    header("index.php");
}
if (isset($_POST['submit'])) {
    $uid = $_SESSION['attendee'];
    $ophnumber = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);

    $stmt = $connection->prepare("UPDATE attendees SET phone = ?, email = ? WHERE attendeeID = ?");
    $stmt->bind_param('sss', $ophnumber, $email, $uid);

    if ($stmt->execute()) {
        echo '<script>alert("Your profile has been updated")</script>';
        echo "<script>window.location.href ='student-profile.php'</script>";
        exit(); // Stop further execution
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Virtual Lean Workshop Platform || Attendees Profile</title>
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
    <!--clock init-->
    <script src="js/css3clock.js"></script>
    <!--Easy Pie Chart-->
    <!--skycons-icons-->
    <script src="js/skycons.js"></script>
    <!--//skycons-icons-->
</head> 
<body>
    <div class="page-container">
        <!--/content-inner-->
        <div class="left-content">
            <div class="inner-content">
                <?php include_once('includes/header.php');?>
                <div class="outter-wp">
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Attendees Profile</li>
                        </ol>
                    </div>
                    <div class="forms-main">
                        <h2 class="inner-tittle">Attendees Profile </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post"> 
                                    <?php
                                        $user = $_SESSION['attendee'];
                                        $stmt = $connection->prepare("SELECT attendees.reg_no, attendees.name, attendees.phone as sphone, attendees.email as semail, workshop.wname from attendees inner join workshop on attendees.wshopID = workshop.wshopID where attendeeID = ?");
                                        $stmt->bind_param('s', $user);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $cnt = 1;
                                        if ($result->num_rows > 0) {
                                            while ($row1 = $result->fetch_assoc()) { ?>
                                                <div class="form-group"> 
                                                    <label for="exampleInputEmail1">Reg number</label> 
                                                    <input type="text" name="" value="<?php  echo $row1['reg_no'];?>" class="form-control" readonly="true"> 
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="exampleInputEmail1">Attendee Name</label> 
                                                    <input type="text" name="" value="<?php  echo $row1['name'];?>" class="form-control" readonly="true"> 
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="exampleInputEmail1">Email</label> 
                                                    <input type="text" name="email" value="<?php  echo $row1['semail'];?>" class="form-control" required="true"> 
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="exampleInputEmail1">Phone</label> 
                                                    <input type="text" name="phone" value="<?php  echo $row1['sphone'];?>" class="form-control" required="true"> 
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="exampleInputEmail1">Institution</label> 
                                                    <input type="text" name="cname" value="<?php  echo $row1['wname'];?>" class="form-control" readonly> 
                                                </div>
                                    <?php 
                                            }
                                        } 
                                    ?> 
                                    <button type="submit" class="btn btn-default" name="submit" id="submit">Update</button> 
                                </form> 
                            </div>
                        </div>
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
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position":"absolute"});
            } else {
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
