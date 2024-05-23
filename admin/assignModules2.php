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
        $uid = intval($_GET['addid']);
        $mids = isset($_POST['mids']) ? $_POST['mids'] : array();
        $assignedBy = $uid;

        foreach ($mids as $mod_id) {
            $sql = "INSERT INTO attendees_modules(attendeeID, ModuleID, createdBy) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("iis", $uid, $mod_id, $assignedBy);
            $stmt->execute();

            $LastInsertId = $stmt->insert_id;
            if ($LastInsertId > 0) {
                echo '<script>alert("Module assigned")</script>';
            } else {
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }
        }
    }
//}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform || Assign Courses </title>
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
                <?php include_once('includes/header.php');?>
                <!-- //header-ends -->
                <!--outter-wp-->
                <div class="outter-wp">
                    <!--sub-heard-part-->
                    <div class="sub-heard-part">
                        <ol class="breadcrumb m-b-0">
                            <li><a href="dashboard.php">Home</a></li>
                            <li class="active">Assign Courses</li>
                        </ol>
                    </div>
                    <!--//sub-heard-part-->
                    <div class="graph-visual tables-main">
                        <h3 class="inner-tittle two"> Assign Courses</h3>
                        <div class="graph">
                            <div class="tables">
                                <form method="post">
                                    <table class="table" border="1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Module Name</th>
                                                <th>Module code</th>
                                                <th>Creation Date</th>
                                                <th>Assign Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $sql = "SELECT * FROM modules";
                                                $result = $connection->query($sql);

                                                if ($result->num_rows > 0) {
                                                    $cnt = 1;
                                                    while ($row1 = $result->fetch_assoc()) {
                                                        echo "<tr class='active'><th scope='row'>" . $cnt . "</th><td>" . $row1["Course_code"] . "</td><td>" . $row1["Course_name"] . "</td><td>" . $row1["created_at"] . "</td><td><input type='checkbox' name='mids[]' value='" . $row1["ModuleID"] . "'></td></tr>";
                                                        $cnt++;
                                                    }
                                                } else {
                                                    echo "0 results";
                                                }
                                            ?>
                                            <tr>
                                                <td colspan="5" align="center">
                                                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--//graph-visual-->
                </div>
                <!--//outer-wp-->
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
        <!--//content-inner-->
        <!--/sidebar-menu-->
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
    <!--js -->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<!-- Your HTML form here -->

