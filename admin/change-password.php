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
if (isset($_POST['submit'])) {
   
    $cpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT password FROM users WHERE usr_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $adminid);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbpassword);
        $stmt->fetch();
        if ($cpassword == $dbpassword) {
            $stmt->close();

            $sql = "UPDATE users SET password=? WHERE usr_id=?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("si", $newpassword, $adminid);
            $stmt->execute();

            echo '<script>alert("Your password successfully changed")</script>';
            echo "<script>window.location.href ='change-password.php'</script>";
        } else {
            echo '<script>alert("Your current password is wrong")</script>';
        }
    } else {
        echo '<script>alert("User not found")</script>';
    }

    $stmt->close();
    
}
?>

<!DOCTYPE HTML>
<html>
<head>virtual lean workshop platform|| Change Password</title>
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
    <script type="text/javascript">
        function checkpass() {
            if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                alert('New Password and Confirm Password field does not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }   
    </script>
</head> 
<body>
    <div class="page-container">
        <!-- Content-inner -->
        <div class="left-content">
            <div class="inner-content">
                <!-- Header -->
                <?php include_once('includes/header.php');?>
                <!-- Outer-wp -->
                <div class="outter-wp">
                    <!-- Sub-heard-part -->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Change Password</li>
                        </ol>
                    </div>
                    <!-- /Sub-heard-part -->
                    <div class="graph-visual tables-main">
                        <h3 class="inner-tittle two">Change Password</h3>
                        <div class="graph">
                            <div class="tables">
                                <form name="changepassword" method="post" onsubmit="return checkpass();" action=""> 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Current Password</label> 
                                        <input type="password" name="currentpassword" id="currentpassword" class="form-control" required="true" value="" > </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">New Password</label> 
                                        <input type="password" name="newpassword"  class="form-control" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" value=""  class="form-control" required="true">
                                    </div>
                                    <button type="submit" class="btn btn-default" name="submit" id="submit">Change</button>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Outer-wp -->
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
        <!-- /Content-inner -->
        <!-- /Sidebar-menu -->
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
    <!-- /JS -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php

?>