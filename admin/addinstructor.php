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
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $inst = $_POST['inst'];
        $password = md5($name);
        $createdBy = $user;
        $role = "2";
        
        // Insert into 'Instructor' table
        $sql = "INSERT INTO instructor (wshopID,name, phone, email, created_by, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("isssss", $inst, $name, $phone, $email, $createdBy, $password);
        $stmt->execute();

        $lastInsertId = $stmt->insert_id;

        if ($lastInsertId > 0) {
            echo '<script>alert("Instructor has been added.")</script>';
            echo "<script>window.location.href ='addinstructor.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>virtual lean workshop platform|| Add Instructor</title>
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
                            <li class="active">Add Instructor</li>
                        </ol>
                    </div>	
                    <div class="forms-main">
                        <h2 class="inner-tittle">Add Instructor </h2>
                        <div class="graph-form">
                            <div class="form-body">
                                <form method="post"> 
                                    <div class="form-group">
                                        <label for="">Workshop</label>
                                        <?php
                                        $query = "SELECT wshopID,wname FROM workshop";
                                        $stmt = $connection->query($query);
                                        echo '<select name="inst" id="inst" class="form-control">';
                                        while ($row1 = $stmt->fetch_assoc()) {
                                            echo '<option value="' . $row1['wshopID'] . '">' . $row1['wname'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="exampleInputEmail1">Instructor Name</label> 
                                        <input type="text" name="name" placeholder="lecture Name" value="" class="form-control" required='true'> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="exampleInputEmail1">Phone</label> 
                                        <input type="text" name="phone" placeholder="Phone number" value="" class="form-control" required='true'> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="exampleInputEmail1">Email</label> 
                                        <input type="text" name="email" placeholder="Email" value="" class="form-control" required='true'> 
                                    </div>
                                    <button type="submit" class="btn btn-default" name="submit" id="submit">Save</button> 
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
