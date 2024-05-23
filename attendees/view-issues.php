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
    }else{

    header("index.php");
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
                               <table class="table" border="1"> <thead> <tr> <th>#</th> 
                                    <th>Attendee's Name</th>
                                    <th>Reg no</th>
                                    <th>problem Issued</th>
                                     
                                     <th>Action</th>
                                      </tr>
                                       </thead>
                                        <tbody>
                                    <?php
                                    $user=$_SESSION['attendee'];
                                    $sql="SELECT * FROM problem_issued INNER JOIN attendees on problem_issued.reporter=attendees.attendeeID WHERE  reporter =?";
                                    $query = $connection->prepare($sql);
$query->bind_param('i', $user);
$query->execute();
$result = $query->get_result();
$cnt = 1;
if ($result->num_rows > 0) {
    while ($row1 = $result->fetch_assoc()) {
        ?>
                                     <tr class="active">
                                      <th scope="row"><?php echo htmlentities($cnt);?></th>
                                       <td><?php  echo htmlentities($row1['name']);?></td>
                                        <td><?php  echo htmlentities($row1['reg_no']);?></td>
                                        <td><?php  echo htmlentities($row1['probem']);?></td>    
                                        <td><a href="report-issue.php?editid=<?php echo $row1['id'];?>">Raise Tickets  </a>|| <a href="view-reply.php?editid=<?php echo $row1['id'];?>"><font color="green">View Reply </font> </a></td>
                                     </tr>
                                     <?php $cnt=$cnt+1;}} ?>
                                     </tbody> </table> 
       
        
        </div>
        
       
</div>
</div>
</div> 
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
