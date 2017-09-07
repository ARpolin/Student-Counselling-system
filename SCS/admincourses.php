<?php 
include 'core/init.php';

if (adminloggedin()===true) {
    $date=date('Y-m-d H:m:s');
    }
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
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>All Courses </strong> </div>
                    </div>
                    <!--Form-->
                    <div>
                        <form class="form-horizontal" action="" method="POST">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="search">Search:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search Course ID or Course Name">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Search</button> 
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn btn-primary">All courses</a>
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
                                    <th>Credit</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            error_reporting(0);

                            //*********pageing***********

                            $page=$_GET['page'];
                            if ($page=="" || $page=="1") {
                                $page1=0;
                            }
                            else
                            {
                                $page1=($page*10)-10;
                            }
                            //***********search**********
                            if (isset($_POST['search']))
                            {
                                $search=$_POST['search'];
                                $search=preg_replace("#[^0-9a-z]#i","", $search);
                                $result=All_course_search($search);
                                $count=mysql_num_rows($result);
                                if ($count==0) 
                                {
                                    echo "<h4 style=\"color=red\">".'No search result Found'."</h4>";
                                } 
                            }
                            else
                            {
                                $result = All_course($page1);
                            }

                            //Fetch All Value.
                            while($row=mysql_fetch_array($result))
                            {
                                $courseid=$row['cid'];
                                $coursename=$row['cname'];
                                $credit=$row['credit'];
                                $semester=$row['semester'];

                                echo "<tr>";
                                echo "<td>" .$courseid. "</td>";
                                echo "<td>" .$coursename. "</td>";
                                echo "<td>" .$credit. "</td>";
                                echo "<td>" .$semester. "</td>";
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
                    <div>

                    <!--Pagging-->
                    <div class="col-md-10">
                        <ul class="pagination" style="width:200px;">    
                    <?php
                       $allpage=all_course_paging();
                       $result1=mysql_num_rows($allpage);
                       $count=$result1/10;
                       $cell=ceil($count);
                       for($pagecount=1;$pagecount<=$cell;$pagecount++)
                       {
                         ?><li><a href="admincourses.php?page=<?php echo $pagecount;?>"><?php echo $pagecount; ?></a></li><?php
                       }
                    ?>

                     

                        </ul>
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
