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
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        //$uid = $_SESSION['vlwpid'];
        $sql = "UPDATE instructor SET name=?, phone=?, email=? WHERE instructorID=?";
        $query = $connection->prepare($sql);
        $query->bind_param('ssss', $name, $phone, $email, $uid);
        $query->execute();
        if ($query->affected_rows > 0) {
            echo '<script>alert("Your profile has been updated")</script>';
            echo "<script>window.location.href ='lecture-profile.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform|| Instructor Profile</title>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
    <!-- //Lined-icons -->
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
    <!-- Content-inner -->
    <div class="left-content">
        <div class="inner-content">

            <?php include_once('includes/header.php');?>
            <!--//outer-wp-->
            <div class="outter-wp">
                <!--/sub-heard-part-->
                <div class="sub-heard-part">
                    <ol class="breadcrumb m-b-0">
                        <li><a href="dashboard.php">Home</a></li>
                        <li class="active">Instructor Profile</li>
                    </ol>
                </div>  
                <!--/sub-heard-part-->  
                <!--/forms-->
                <div class="forms-main">
                    <h2 class="inner-tittle">Instructor Profile </h2>
                    <div class="graph-form">
                        <div class="form-body">
                            <form method="post"> 
                                <?php
                                $user = $_SESSION['instructor'];
                         $sql = "SELECT * FROM instructor WHERE instructorID=?";
                                $query = $connection->prepare($sql);
                                $query->bind_param('s', $user);
                                $query->execute();
                                $result = $query->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row1 = $result->fetch_assoc()) {
                                ?>
                                        <div class="form-group"> <label for="exampleInputEmail1">Names</label> <input type="text" name="name" value="<?php echo $row1['name']; ?>" class="form-control" readonly="true"> </div>
                                        <div class="form-group"> <label for="exampleInputEmail1">Phone</label> <input type="text" name="phone" value="<?php echo $row1['phone']; ?>" class="form-control" readonly="true"> </div>
                                        <div class="form-group"> <label for="exampleInputEmail1">Email</label> <input type="text" name="email" value="<?php echo $row1['email']; ?>" class="form-control" required="true"> </div>
                                        <div class="form-group"> <label for="exampleInputEmail1">Workshop</label> <input type="text" name="comname" value="" class="form-control" required="true"> </div>
                                <?php
                                    }
                                }
                                ?> 
                                <button type="submit" class="btn btn-default" name="submit" id="submit">Update</button> </form> 
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
