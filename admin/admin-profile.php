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
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Virtual lean worshop platform || Admin Profile</title>
    <script type="application/x-javascript"> 
        addEventListener("load", function() { 
            setTimeout(hideURLbar, 0); 
        }, false); 
        function hideURLbar() { 
            window.scrollTo(0,1); 
        } 
    </script>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/css3clock.js"></script>
    <script src="js/skycons.js"></script>
</head> 
<body>
    <div class="page-container">
        <div class="left-content">
            <div class="inner-content">
                <?php include_once('includes/header.php');?>
                <div class="outter-wp">
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Profile</li>
                        </ol>
                    </div>	
                    <div class="forms-main">
                        <h2 class="inner-tittle">Admin Profile </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post"> 
                                    <?php
                                    
                                    $sql = "SELECT * FROM users WHERE usr_id='$user'";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        $row1 = $result->fetch_assoc();
                                        ?>  
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Admin Name</label> 
                                            <input type="text" name="adminname" value="<?php echo $row1['userName']; ?>" class="form-control" required='true'> 
                                        </div>
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1">Email address</label> 
                                            <input type="email" name="email" value="<?php echo $row1['email']; ?>" class="form-control" required='true'> 
                                        </div> 
                                        <div class="form-group"> 
                                            <label for="exampleInputPassword1">Admin Registration Date</label> 
                                            <input type="text" name="" value="<?php echo $row1['created_at']; ?>" readonly="" class="form-control"> 
                                        </div>
                                    <?php } ?> 
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
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php  ?>
