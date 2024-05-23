<?php
session_start();
include('includes/dbconnection.php'); // Assuming dbconnection.php contains your database connection settings and establishes the connection
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
    // Retrieve form data
    $iname = $_POST['iname'];
    $address = $_POST['address'];
    $url = $_POST['url'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($iname);
    $createdBy = $iname;

    // Prepare SQL statement to insert data into the workshop table
    $query = "INSERT INTO workshop (wname, physical_addres, url, email, phone, password, createdBy) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssssss", $iname, $address, $url, $email, $phone, $password, $createdBy);

    // Execute the query
    if ($stmt->execute()) {
         echo '<script>alert("Workshop has been added.")</script>';
            echo "<script>window.location.href ='addwshop.php'</script>";
       
        exit();
    } else {
        // Handle any errors that occur during insertion
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Virtual Lean Workshop Platform|| Add Workshop</title>

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
                <!--//outer-wp-->
<div class="outter-wp">
                    <!--/sub-heard-part-->
<div class="sub-heard-part">
<ol class="breadcrumb m-b-0">
<li><a href="dashboard.php">Home</a></li>
<li class="active">Add Workshop</li>
</ol>
</div>  
                    <!--/sub-heard-part-->    
                    <!--/forms-->
<div class="forms-main">
<h2 class="inner-tittle">Add Workshop </h2>
<div class="graph-form">
<div class="form-body">
<form method="post">    
<div class="form-group"> <label for="exampleInputEmail1">Workshop Name</label> <input type="text" name="iname" placeholder="Workshop Name" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Physical Address</label> <input type="text" name="address" placeholder="Physical address" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Url</label> <input type="text" name="url" placeholder="Url" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Email</label> <input type="email" name="email" placeholder="Email" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Phone</label> <input type="text" name="phone" placeholder="Phone number" value="" class="form-control" required='true'> </div>
     <button type="submit" class="btn btn-default" name="submit" id="submit">Save</button> </form> 
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
