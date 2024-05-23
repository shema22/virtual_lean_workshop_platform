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
        $att = $_POST['attendeeID'];
        $pay = $_POST['pay_method'];
        $amount = $_POST['amount'];
        $prof = $_POST['proof'];
        

        $sql = "INSERT INTO application(attendeeID,pay_method,amount,proof) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("isss", $att, $pay, $amount, $prof,);
        $stmt->execute();

        $lastInsertId = $stmt->insert_id;
        if ($lastInsertId > 0) {
            echo '<script>alert("Applicationn has been send.")</script>';
            echo "<script>window.location.href ='viewapplication.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform || Add Application</title>
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
                            <li class="active">Add Application</li>
                        </ol>
                    </div>	
                    
                    <!--/sub-heard-part-->  
                    <!--/forms-->
<div class="forms-main">
<h2 class="inner-tittle">Add Application </h2>
<div class="graph-form">
<div class="form-body">
<form method="post">    

    <div class="form-group"> <label for="exampleInputEmail1">Attendee ID</label> <input type="text" name="attendeeID" placeholder=" Attendee ID" value="<?php echo $row['attendeeID'];?>" class="form-control" required='true' readonly='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Payment Method</label>

    <select name="pay_method" class="form-control"><option>Select Payment method</option>
    <option>Bank method</option>

<option>MM Method</option>
<option>cashless Method</option></select>  </div>
<div class="form-group"> <label for="exampleInputEmail1">Amount</label> <input type="text" name="amount" placeholder=" Enter Amount you Pay" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">Proof of Payment</label> <input type="file" id="file" name="proof" placeholder=" Upload you document as proof" value="" class="form-control" required='true'> </div>

     <button type="submit" class="btn btn-default" name="submit" id="submit">Send</button> </form> 
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
<?php   ?>