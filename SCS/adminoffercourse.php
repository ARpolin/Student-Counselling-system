<?php
include 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <!--style CSS-->
    <link rel="stylesheet" href="css/style.css" />

   

</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand" style="background:black">
                    <a href="Adminprofile.php">
                        Welcome Admin
                    </a>
                </li>
                <li>
                    <a href="AdminProfile.php">Profile</a>
                </li>
                <li>
                    <a href="admincourses.php">Courses</a>
                </li>
                <li>
                    <a href="adminnotice.php">Notice</a>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <div style="background:black">
                            <li><a href="facultyreg.php">Faculty Registration</a></li>
                            <li><a href="studentreg.php">Student Registration</a></li>   
                        </div>
                    </ul>
                </li>

                <li>
                    <a href="admininbox.php">Inbox</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                <!--OverView-->
                    <div class="col-lg-12">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> Offered Courses </strong> </div>
                    </div>

                    <div class="btn-group btn-group-justified">
                        <a href="admincourses.php" class="btn btn-primary">All courses</a>
                        <a href="adminfacultylist.php" class="btn btn-primary">Faculty List</a>
                        <a href="adminoffercourse.php" class="btn btn-primary">Offered Courses</a>
                        <a href="admincoursereg.php" class="btn btn-primary">Course Registration</a>
                    </div>
                    <br> 
                     
                    <div class="col-md-12">         
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course ID:</th>
                                    <th>Course Name:</th>
                                    <th>Sec</th>
                                    <th>Time</th>
                                    <th>Credit</th>
                                    <th>Limit</th>
                                    <th>Session</th>
                                    <th>Faculty ID</th>
                                    <th>Faculty Name</th>
                                    <th>Fill</th>
                                    <th>Update Info</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $result = admin_offer_course();
                            //Fetch All Value.
                            while($row=mysql_fetch_array($result))
                            {
                                $courseid=$row['cid'];
                                $coursename=$row['cname'];
                                $sec=$row['csec'];
                                $time=$row['ctime'];
                                $credit=$row['credit'];
                                $limit=$row['limit'];
                                $session=$row['session'];
                                $fid=$row['fid'];
                                $fname=$row['fname'];
                                $fill=$row['fill'];

                                echo "<tr>";
                                echo "<td>" .$courseid. "</td>";
                                echo "<td>" .$coursename. "</td>";
                                echo "<td>" .$sec. "</td>";
                                echo "<td>" .$time. "</td>";
                                echo "<td>" .$credit. "</td>";
                                echo "<td>" .$limit. "</td>";
                                echo "<td>" .$session. "</td>";
                                echo "<td>" .$fid. "</td>";
                                echo "<td>" .$fname. "</td>";
                                echo "<td>" .$fill. "</td>";
                                echo "<form action=\"\" method=\"POST\">";
                                echo "<td>
                                    <input type=\"button\" value=\" Edit\" class=\"btn btn-primary\">
                                    <input type=\"button\" value=\" Delete\" class=\"btn btn-primary\" onClick=\"return confirm('Are you sure you want to delete?')\">
                                </td>";
                                echo "</form>";
                            }
                            ?>

                            </tbody>
                            </table>
                    
              
  

        		</div>
    		</div>
    </div>
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
