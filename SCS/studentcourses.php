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

    <title>Student Counselling System</title>

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
                       Welcome Student
                    </a>
                </li>
                <li>
                    <a href="studentprofile.php">Profile</a>
                </li>
                <li>
                    <a href="studentcourses.php">Courses</a>
                </li>
                <li>
                    <a href="studentappointment.php">Appointment</a>
                </li>
                <li>
                    <a href="studentdiscussion.php">Discussion</a>
                </li>
                <li>
                    <a href="">Download Notes</a>
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
                    <?php
                        if (isset($_GET['msg'])) {
                            $id=$_GET['msg'];
                            $student_session=$suserdata['userid'];
                            if (student_course_exists($id) === false) {
                                $courseid=insert_course_id($id,$student_session);
                                echo "<Strong>".'Successfully Added courses'. "</strong>";
                                student_fill($id);
                            }
                            else{
                                echo "<Strong>".'You Already Add This Courses'. "</strong>";
                            }

                        }
                        else
                        {
                            echo "<Strong>".'Please select a course'. "</strong>";
                        }

   
                    ?>

                    <div class="btn-group btn-group-justified">
                        <a href="studentcourses.php" class="btn btn-primary">Offered Courses</a>
                        <a href="studentvalidcourse.php" class="btn btn-primary">Valid courses</a>
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
                                    <th>Fill</th>
            
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $result = student_offer_course();
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
                                $fill=$row['fill'];

                                echo "<tr>";
                                echo "<td>" .$courseid. "</td>";
                                echo "<td>" .$coursename. "</td>";
                                echo "<td>" .$sec. "</td>";
                                echo "<td>" .$time. "</td>";
                                echo "<td>" .$credit. "</td>";
                                echo "<td>" .$limit. "</td>";
                                echo "<td>" .$session. "</td>";
                                echo "<td>" .$fill. "</td>";
                                echo '<td><a href="?msg='.$courseid.'">' ."<input type=\"Submit\" value=\" Add\" class=\"btn btn-primary\">". '</a></td>';
                                
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
