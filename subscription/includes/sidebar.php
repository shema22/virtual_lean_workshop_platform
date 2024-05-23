
 <div class="sidebar-menu">
    <header class="logo">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="dashboard.php"> <span id="logo"> <h1>VLWP</h1></span> 
            <!--<img id="logo" src="" alt="Logo"/>--> 
        </a> 
    </header>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
    <!--/down-->
    <div class="down">  
        <a href="dashboard.php"><img src="images/images.jpg" height="70" width="70"></a>
        <a href="dashboard.php"><span class=" name-caret">Admin panel</span></a>
    
        <ul>
            <li><a class="tooltips" href="admin-profile.php"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
            <li><a class="tooltips" href="change-password.php"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
            <li><a class="tooltips" href="logout.php"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
        </ul>
    </div>
    <!--//down-->
    <div class="menu">
        <ul id="menu" >
            <li><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

            <li id="menu-academico" ><a href="#"><i class="fa fa-user"></i><span>workshops</span> <span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="addwshop.php"> Add workshop</a></li>
                    <li id="menu-academico-boletim" ><a href="manageWshop.php">Manage workshops</a></li>
                   
                </ul>
            </li>

            <li id="menu-academico" ><a href="#"><i class="fa fa-user"></i><span>Instructor</span> <span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="addinstructor.php"> Add Instructor</a></li>
                    <li id="menu-academico-boletim" ><a href="manage_instructor.php">Manage Instructor</a></li>
                   
                </ul>
            </li>            

            <li id="menu-academico" ><a href="#"><i class="fa fa-user"></i><span>Attendees</span> <span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="add_attendee.php"> Add Attendee</a></li>
                    <li id="menu-academico-boletim" ><a href="manage_attendee.php">Manage Attendees</a></li>
                   
                </ul>
            </li>

            <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i><span>Courses</span> <span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="addCourse.php"> Add Course</a></li>
                    <li id="menu-academico-boletim" ><a href="manageCourses.php">Manage Courses</a></li>
                   
                </ul>
            </li>          
            
      
            <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i><span>Problem Reported</span> <span class="fa fa-angle-right" style="float: right"></span></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-avaliacoes" ><a href="Instructorproblem.php"> From Instructor</a></li>
                    <li id="menu-academico-boletim" ><a href="Attendeeproblem.php">From Attendee</a></li>
                   
                </ul>
            </li>          
            
        </ul>
    </div>
</div>