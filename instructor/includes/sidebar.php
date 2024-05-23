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
$user=$_SESSION['instructor'];
$sql="SELECT instructor.name,workshop.wname from  instructor inner join workshop on instructor.wshopID = workshop.wshopID where instructorID=?";
$query = $connection -> prepare($sql);
$query->bind_param('s',$user);
$query->execute();
$cnt=1;
 $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row1 = $result->fetch_assoc();
       
            ?> 
        <a href="dashboard.php"><img src="images/admin10.jpg" height="100" width="100"></a>
        <a href="dashboard.php"><span class=" name-caret"><?php echo $row1['name'];?></span></a>
        <?php $cnt=$cnt+1;} ?>
        <p>Instructor in <?php echo $row1['wname'];?></p>
        <ul>
            <li><a class="tooltips" href="lecture-profile.php"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
            <li><a class="tooltips" href="change-password.php"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
            <li><a class="tooltips" href="logout.php"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
        </ul>
    </div>
    <!--//down-->
    <div class="menu">
        <ul id="menu">
            <li><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li><a href="listOfModules.php"><i class="fa fa-check" aria-hidden="true"></i><span>Make Attendance</span></a></li>
            <li><a href="viewAttendance2.php"><i class="fa fa-list" aria-hidden="true"></i><span>Attendances</span></a></li>
            <li><a href="examEntry.php"><i class="fa fa-list" aria-hidden="true"></i><span>Attendance Report</span></a></li>

           
            <li><a href="searchAttendance.php"><i class="fa fa-search"></i> <span>Search Attendance</span></a></li>
         
        </ul>
    </div>
</div>