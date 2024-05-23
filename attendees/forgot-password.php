<?php
session_start();
error_reporting(0);
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
    }
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $newpassword=md5($_POST['newpassword']);

    $sql ="SELECT email FROM attendees WHERE email=? and phone=?";
    $query= $conn->prepare($sql);
    $query->bind_param('ss', $email, $mobile);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0)
    {
        $con="update attendees set password=? where email=? and phone=?";
        $chngpwd1 = $conn->prepare($con);
        $chngpwd1->bind_param('sss', $newpassword, $email, $mobile);
        $chngpwd1->execute();
        echo "<script>alert('Your Password successfully changed');</script>";
    }
    else {
        echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Virtual lean workshop platform||Forgot Password Page</title>

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
    <script type="text/javascript">
    function valid()
    {
        if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value)
        {
            alert("New Password and Confirm Password Field do not match  !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
</head> 
<body>
    <div class="error_page">
        <div class="error-top">
            <h2 class="inner-tittle page">VLWP Attendees</h2>
            <div class="login">
                
                <div class="buttons login">
                    <h3 class="inner-tittle t-inner" style="color: lightblue">Forgot Password</h3>
                </div>
                <form id="login" method="post" name="chngpwd" onSubmit="return valid();"> 

                    <input type="text" class="text" value="E-mail Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}" name="email" required="true">
                    <input type="text" class="text" value="Mobile Number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}" required="true" name="mobile" maxlength="10" pattern="[0-9]+">
                    <input type="password" value="New Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" name="newpassword" required="true">
                    <input type="password" value="Confirm Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" name="confirmpassword" required="true">
                    <div class="submit"><input type="submit" onclick="myFunction()" value="Reset" name="submit" ></div>
                    <div class="clearfix"></div>

                    <div class="new">
                        <p><a href="index.php">Already have an account</a></p>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--footer section start-->
    <div class="footer">
        <?php include_once('includes/footer.php');?>
    </div>
    <!--footer section end-->
    <!--/404-->
    <!--js -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
