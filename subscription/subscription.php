<?php
session_start();
include('includes/dbconnection.php');
    if (isset($_POST['subscribe'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
  
        // Insert into 'subscribe' table
        $sql2 = "INSERT INTO subscribe (name,email,password) VALUES (?, ?, ?)";
        $stmt2 = $connection->prepare($sql2);
        $stmt2->bind_param("sss",$name,$email,$password);
        $stmt2->execute();

        if ($stmt2> 0) {
            echo '<script>alert("your subscription recieved.")</script>';
            echo "<script>window.location.href ='../index.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform||subscription Page</title>

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
</head> 
<body>
    <div class="error_page">

        <div class="error-top">
            <h2 class="inner-tittle page">VLWP</h2>
            <div class="login">
                
                <div class="buttons login">
                    <h3 class="inner-tittle t-inner" style="color:red;">Subscription</h3>
                </div>
                <form id="register" method="post" name="subscribe"> 
                    <input type="text" name="name" placeholder="Enter your Name" value="" class="form-control" required='true'> 
                    <input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}" name="email" required="true">
                    
                    <input type="password" name="password" placeholder="Enter your password" class="form-control" required="true" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                    <div class="submit"><input type="submit" onclick="myFunction()" value="subscribe" name="subscribe" ></div>
                    <div class="clearfix"></div>

                    <div class="new">
                        <p><a href="index.php">Back Home!!</a></p>

                        <div class="clearfix"></div>
                       </div></a>
                    </div>
                </form>
            </div>


        </div>


        <!--//login-top-->
    </div>

    <!--//login-->
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