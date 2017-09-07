<?php
include 'core/init.php';
if (adminloggedin()===true) {
    $date=date('Y-m-d H:m:s');
    }

if(empty($_POST)===false)
{
  $required_fields=array('dob','session');
  foreach ($_POST as $key => $value) {
    if (empty($value)&& in_array($value,$_POST)===true) 
    {
      $error[]="Field marked with an asterisk are required";
      break 1;
    }
  }
 if (empty($error)===true) {

    if (strlen($_POST['dob'])<10) {
     $error[]='Admin user id must be 14 character Like xxx-xxxxxx-xxx';
   }
   if (strlen($_POST['dob'])>10) {
     $error[]='Admin user id must be 14 character Like xxx-xxxxxx-xxx';
   }
   
    


 }
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
                    <a href="studentappointment.php">Appoinment</a>
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
                    <div class="col-lg-10">
                    <?php
                        if (isset($_GET['success'])&& empty($_GET['success'])) 
                        {
                             echo '<div class="alert alert-success">'.'<strong>'.'Successfully Update Your Information'.'</strong>' .'</div>';
                        }
                        else{
                            if (empty($_POST)===false && empty($error)===true) 
                            {       
                                student_update_info($ssession_user_id,  $_POST['dob'],  $_POST['session'],  $_POST['number'],  $_POST['address']);
                                header('Location:studentprofile.php?success');
                                exit();
                            }
                            else if (empty($error)===false) {
                                  echo '<div class="alert alert-danger">'.'<strong>'. output_errors($error).'</strong>'. '</div>';
                            }
                        }
                        ?>
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> OverView </strong> </div>
                    </div>
                     
                        
                    <div class="col-lg-2 offset">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Settings
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="studentchangepass.php">Change password</a></li>
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
                                student_profile_image($ssession_user_id,$file_temp,$file_extn);
                            }
                            else
                            {
                                echo '<font color="red">'."Incorrect file type.Allowed:" .'</font>';
                                echo implode(', ', $allowed);
                            }
                        }
                    }
                    if (empty($suserdata['profile'])===false) {
                        echo '<img src="',$suserdata['profile'],'"alt="',suserdata['username'],'\'s profile Image" style="width:250px;height:228px;border:1px solid black">'; 
                    }

                    ?>
                    </div>
                            
                    <div class="col-md-8" style="font-size:15px;">
                        <p><strong> User ID:</strong> <?php echo $suserdata['userid'];?></p>
                        <p><strong> User Name: </strong> <?php  echo $suserdata['username'];?></p>
                    </div>
                    <!--OverView-->
                    <div class="col-lg-12">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> Additional Imformation </strong> </div>
                        <div style="margin-left:50px;width:500px;">
                            <p>Date of birth: <strong> <?php echo $suserdata['dob'];?> </strong></p>
                            <p>Session: <strong><?php echo $suserdata['session'];?></strong></p>
                            <p>Phone Number: <strong><?php echo $suserdata['phnnum'];?></strong></p>
                            <p>Address: <strong><?php echo $suserdata['address'];?></strong></p>
                            <br>
                            <form>
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#myModal">Update Info</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <!-- /#wrapper -->

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Information</h4>
      </div>
      <div class="modal-body">
     
            <form action="" method="POST">
                <div style="width:400px; margin:auto;">
                  <div class="form-group">
                    <label for="dob">Date of Birth:*</label>
                    <input type="text" class="form-control" name="dob" placeholder="Date of Birth">
                  </div>
                  <div class="form-group">
                    <label for="session">Session:*</label>
                    <input type="text" class="form-control" name="session" placeholder="Session">
                  </div>
                  <div class="form-group">
                    <label for="phoneno">Phone Number:</label>
                    <input type="text" class="form-control" name="number" placeholder="Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                  </div>
                 
                  <div class="col-md-6">
                        <input type="submit" value="update" class="btn btn-primary">
                   </div> 
                </div>
            </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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
