<?php
include 'core/init.php';
if(empty($_POST)===false)
{
  $required_fields=array('currentpassword','newpassword','passwordagain');
  foreach ($_POST as $key => $value) {
    if (empty($value)&& in_array($value,$_POST)===true) 
    {
      $error[]="Field marked with an asterisk are required";
      break 1;
    }
  }
  if (md5($_POST['currentpassword'])===$userdata['password']) 
  {
    if (trim($_POST['newpassword'])!==trim($_POST['passwordagain'])) 
    {
        $error[]="Your password do not match";
    }
    else if(strlen($_POST['newpassword'])<5)
    {
        $error[]='Your password must be at least 6 characters';
    }
  }
  else
  {
    $error[]="Your Current password is incorrect";
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
                    <a href="Adminprofile.html">
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
                      <li><a href="facultyreg.php">Faculty Registration</a></li>
                      <li><a href="studentreg.php">Student Registration</a></li>
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

                <div class="col-lg-12 col-md-offset overview">

                <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>Change Password</strong></div> 
                
                <!--**************changepassword************-->
                <?php
                if (isset($_GET['success'])&& empty($_GET['success'])) 
                {
                     echo '<font color="green">'.'Your Password have been changed'.'</font>';
                }
                else{
                    if (empty($_POST)===false && empty($error)===true) 
                    {       
                        admin_change_password($session_user_id,$_POST['newpassword']);
                        header('Location:adminchangepass.php?success');
                        exit();
                    }
                    else if (empty($error)===false) {
                        //echo output_errors($error);
                    }
                }
                ?>

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
                            change_profile_image($session_user_id,$file_temp,$file_extn);
                        }
                        else
                        {
                            echo '<font color="red">'."Incorrect file type.Allowed:" .'</font>';
                            echo implode(', ', $allowed);
                        }
                    }
                }
                if (empty($userdata['profile'])===false) {
                    echo '<img src="',$userdata['profile'],'"alt="',userdata['name'],'\'s profile Image" style="width:250px;height:228px;border:1px solid black">'; 
                }

                ?>
                </div>

                <div class="changepass" style="margin-left:10px;width:600px;">
                    <?php 
                    echo '<font color="red">'. output_errors($error) .'</font>';
                    ?>
                </div>
                <div class="changepass">
                    <form action="" method="POST">
                            
                          <div class="form-group changepassop">
                            <label for="currentPassword">Current Password*:</label>
                            <input type="password" class="form-control" name="currentpassword" id="email" placeholder="Current Passwod">
                          </div>

                          <div class="form-group changepassop">
                            <label for="newPassword">New Password*:</label>
                            <input type="password" class="form-control" name="newpassword" id="pwd"placeholder="New Password">
                          </div>

                          <div class="form-group changepassop">
                            <label for="password Again">Password Again*:</label>
                            <input type="password" class="form-control" name="passwordagain" id="pwd"placeholder="Password Again">
                          </div>

                          <div style="margin-left:260px;">
                              <button type="submit" class="btn btn-default">Change Password</button>
                          </div>
                          
                    </form>
                </div>
                </div>

                <div class="changeimg">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" class="btn btn-default" name="profile"><br>
                        <input type="submit" class="btn btn-primary" value="Change Image">
                    </form>

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
