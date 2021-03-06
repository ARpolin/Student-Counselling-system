<?php 
include 'core/init.php';

if (facultyloggedin()===true) {
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
                    <div class="col-lg-10">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> OverView </strong> </div>
                    </div>
                        
                    <div class="col-lg-2 offset">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Settings
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="facultychangepass.php">Change password</a></li>
                                <li><a href="#"><?php echo 'logged in at'?> </a></li>
                                <li><a href="#"><?php echo $date;?> </a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                        
                        
                    <div class=" col-md-12">
                        <p><strong>Profile Image</strong></p>
                    </div>

                <!--****************image****************-->
                    <div class="img">
                    <?php
                    if (isset($_FILES['profile'])===true) {
                        if (empty($_FILES['profile'] ['name'])===true) {
                            echo '<font color="red">'. "Please choose a file" .'</font>';
                        }
                        else{
                            $allowed=array('jpg','jpeg','gif','png');
                            $filename=$_FILES['profile']['name'];
                            $file_extn=strtolower(end(explode('.', $filename))) ;
                            $file_temp=$_FILES['profile']['tmp_name'];

                            if (in_array($file_extn, $allowed)===true) {
                                faculty_profile_image($fsession_user_id,$file_temp,$file_extn);
                            }
                            else
                            {
                                echo '<font color="red">'."Incorrect file type.Allowed:" .'</font>';
                                echo implode(', ', $allowed);
                            }
                        }
                    }
                    if (empty($fuserdata['profile'])===false) {
                        echo '<img src="',$fuserdata['profile'],'"alt="',fuserdata['username'],'\'s profile Image" style="width:250px;height:228px;border:1px solid black">'; 
                    }

                    ?>
                    </div>
                            
                    <div class="col-md-8" style="font-size:15px;">
                        <p><strong> User ID:</strong> <?php echo $fuserdata['userid'];?></p>
                        <p><strong> User Name: </strong> <?php  echo $fuserdata['username'];?></p>
                    </div>
                    <!--OverView-->
                    <div class="col-lg-12">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> Additional Imformation </strong> </div>
                        <div style="margin-left:50px;width:500px;">
                            <p>Date of birth:</p>
                            <p>Session:</p>
                            <p>Phone Number:</p>
                            <p>Address:</p>
                            <br>
                            <form>
                                <input type="submit" class="btn btn-primary" value="Update Info">
                            </form>
                        </div>
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
