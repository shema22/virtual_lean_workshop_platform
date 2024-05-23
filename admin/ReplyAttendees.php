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
    }//--- session--
 if (isset($_POST['submit'])) {
        $eid=$_GET['editid'];
        $name = $_POST['id'];
        $reg = $_POST['reg_no'];
        $email = $_POST['email'];
        $prob1 = $_POST['problem'];
        $rep = $_POST['reply'];
        $createdBy = $user;
        $sql="INSERT INTO problem_reply(rep,reply) VALUES(?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $eid, $rep);
        $stmt->execute();

        $lastInsertId = $stmt->insert_id;
        if ($lastInsertId > 0) {
            echo '<script>alert("Reply has been Sent Successfuly.")</script>';
            echo "<script>window.location.href ='Attendeeproblem.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
  
  }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform|| Reply Services</title>
    <!-- Include CSS and JavaScript files -->
    <script type="application/x-javascript">addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <!-- Graph CSS -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- jQuery -->
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet'
              type='text/css'>
        <!-- lined-icons -->
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css'/>
        <!-- /js -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <!-- //js-->
</head> 
<body>
    <div class="page-container">
        <!-- Content Inner -->
        <div class="left-content">
            <div class="inner-content">
                <?php include_once('includes/header.php'); ?>

                <!-- Outer WP -->
                <div class="outter-wp">
                    <!-- Sub Heard Part -->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Reply Attendee</li>
                        </ol>
                    </div>	
                    <!-- /Sub Heard Part -->	
                    <!-- Forms -->
                    <div class="forms-main">
                        <h2 class="inner-tittle">Reply Attendee Problem </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post"> 
                                    <?php
                                    $eid=$_GET['editid'];
                                    $sql="SELECT * FROM problem_issued INNER JOIN attendees on problem_issued.reporter=attendees.attendeeID WHERE  id =?";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("s", $eid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        while ($rows = $result->fetch_assoc()) {
                                            ?>
        <div class="form-group"> 
        <label for="exampleInputEmail1">Attendee ID</label> 
        <input type="text" name="id" value="<?php echo $rows['reporter']; ?>" class="form-control" required='true' readonly="true"> 
        </div>
        <div class="form-group"> 
       <label for="exampleInputEmail1">Reg number</label> 
        <input type="text" name="reg" value="<?php echo $rows['reg_no']; ?>" class="form-control" required='true'  readonly="true"> 
        </div>
        <div class="form-group"> 
        <label for="exampleInputEmail1">Email</label> 
        <input type="text" name="email" value="<?php echo $rows['email']; ?>" class="form-control" required='true' readonly="true"> 
        </div>
        <div class="form-group"> 
        <label for="exampleInputEmail1">Problem Issued</label> 
        <input type="text"  type="text" name="problem" value="<?php echo $rows['probem']; ?>" class="form-control" required='true' readonly="true"> </div>
        <div><label>Reply</label>
        <textarea type="text" name="reply" placeholder="reply" class="form-control" required='true' > </textarea></div>
        
        </div>
        <?php }
         } ?>
        <button type="submit" class="btn btn-default" name="submit" id="submit">send</button> 
</form> 
</div>
</div>
</div> 
                    <!-- /Forms -->
                </div>
                <!-- /Outer WP -->
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>		
        <?php include_once('includes/sidebar.php'); ?>
        <div class="clearfix"></div>		
    </div>
    <!-- JavaScript scripts -->
</body>
</html>
