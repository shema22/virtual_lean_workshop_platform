<?php
session_start();
error_reporting(0);
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
        <title>Virtual lean workshop platform|| Manage attendees </title>
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
        <!--/content-inner-->
        <div class="left-content">
            <div class="inner-content">
                <!-- header-starts -->
                <?php include_once('includes/header.php'); ?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Manage Attendees</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">


                        <h3 class="inner-tittle two">Manage Attendees </h3>
                        <div class="graph">
                            <div class="tables">
                                <table class="table" border="1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Name</th>
                                        <th>workshop</th>
                                        <th>Reg number</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM attendees INNER JOIN workshop ON attendees.wshopID = workshop.wshopID";
                                    $result = $connection->query($sql);

                                    if ($result->num_rows > 0) {
                                        $cnt = 1;
                                        while ($row1 = $result->fetch_assoc()) {
                                            ?>
                                            <tr class="active">
                                                <th scope="row"><?php echo htmlentities(($cnt)); ?></th>
                                                <td><?php echo htmlentities($row1['name']); ?></td>
                                                <td><?php echo htmlentities($row1['wname']); ?></td>
                                                <td><?php echo htmlentities($row1['reg_no']); ?></td>
                                                <td><?php echo htmlentities($row1['email']); ?></td>
                                                <td><a href="editAttendeesDetails.php?editid=<?php echo $row1['attendeeID']; ?>">Edit</a>
                                                    || <a href="assignModules2.php?addid=<?php echo $row1['attendeeID']; ?>">Assign Module</a></td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No records found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                    <!--//graph-visual-->
                </div>
                <!--//outer-wp-->
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        <!--//content-inner-->
        <!--/sidebar-menu-->
        <?php include_once('includes/sidebar.php'); ?>
        <div class="clearfix"></div>
    </div>
    <script>
        var toggle = true;

        $(".sidebar-icon").click(function() {
            if (toggle) {
                $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                $("#menu span").css({"position": "absolute"});
            } else {
                $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                setTimeout(function() {
                    $("#menu span").css({"position": "relative"});
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
    <?php

?>
