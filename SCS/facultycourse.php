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
                       Welcome Faculty
                    </a>
                </li>
                <li>
                    <a href="facultyprofile.php">Profile</a>
                </li>
                <li>
                    <a href="facultycourse.php">Courses</a>
                </li>
                <li>
                    <a href="#">Appoinment</a>
                </li>
                <li>
                    <a href="#">Discussion</a>
                </li>
                <li>
                    <a href="facultyuploadnotes.php">Upload Notes</a>
                </li>

                <li>
                    <a href="#">Inbox</a>
                </li>
                <li>
                    <a href="Logout.php">Logout</a>
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
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> Courses </strong> </div>
                    </div>
                    <div class="col-md-12">         
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Student ID:</th>
                                    <th>Student Name:</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (isset($_GET['course'])) {
                                    $courseid=$_GET['course'];
                                    $result=get_student($courseid);
                                    while($row=mysql_fetch_array($result)){
                                        # code...
                                    
                                        $id=$row['userid'];
                                        $name=$row['username'];                             
                                        echo "<div id=\"course\" class=\"col-md-12\" style=\"margin-top:10px;\" >";
                                        echo "<tr>";
                                        echo "<td>" .$id. "</td>";
                                        echo "<td>" .$name. "</td>"; 
                                        echo '</div>';                  
                              }
                               
                              ?>       
                            </tbody>
                        </table>
                    </div>
                            
    
                        
                    </div>

                    <?php exit();}?>



                        
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
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $faculty_session=$fuserdata['userid'];
                             $result = faculty_offer_course($faculty_session);
                            //Fetch All Value.
                            while($row=mysql_fetch_array($result))
                            {
                                $id=$row['id'];
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

                                echo '<tr>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$courseid. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$coursename. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$sec. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$time. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$credit. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$limit. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$session. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$fid. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$fname. '</a></strong></td>';
                                echo '<td><strong><a href="?course='.$courseid.'">' .$fill. '</a></strong></td>';
                                
                            }
                            ?>

                            </tbody>
                            </table>
                </div>





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
