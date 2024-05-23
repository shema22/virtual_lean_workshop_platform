<div class="sidebar-menu">
    <header class="logo">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="dashboard.php"> <span id="logo"> <h1>VLWP</h1></span> 
            <!--<img id="logo" src="" alt="Logo"/>--> 
        </a> 
    </header>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
    <!--/down-->
    <div class="down">
   <?php
    $user = $_SESSION['attendee'];
    $sql = "SELECT name FROM attendees WHERE attendeeID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <a href="dashboard.php"><img src="images/admin10.jpg" height="100" width="100"></a>
        <a href="dashboard.php"><span class=" name-caret"><?php echo $row['name'];?></span></a>
        <p>Attendee</p>
        <ul>
            <li><a class="tooltips" href="attendee-profile.php"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
            <li><a class="tooltips" href="change-password.php"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
            <li><a class="tooltips" href="logout.php"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
        </ul>
        <?php
    }
    ?>
    </div>
    <!--//down-->
    <div class="menu">
        <ul id="menu" >
            <li><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li><a href="viewAttendance.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>View Attendees</span></a></li>
            <li><a href="application.php"><i class="fa fa-pgraduation-cap" aria-hidden="true" ></i> <span>Applications</span></a></li>
 <li><a href="report-issue.php"><i class="fa fa-pgraduation-cap" aria-hidden="true" ></i> <span>Raise Tickets</span></a></li>
 <li><a href="view-issues.php"><i class="fa fa-pgraduation-cap" aria-hidden="true" ></i> <span>My Tickets</span></a></li>

         
        </ul>
    </div>
</div>
