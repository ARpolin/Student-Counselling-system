<?php
include 'core/init.php';

if(empty($_POST)===false)
{
  $required_fields=array('userid','username','password','passwordagain','active');
  foreach ($_POST as $key => $value) {
    if (empty($value)&& in_array($value,$_POST)===true) 
    {
      $error[]="Field marked with an asterisk are required";
      break 1;
    }
  }
 if (empty($error)===true) {
   if (studentuserid_exists($_POST['userid'])===true) {
     $error[]='Sorry,the userID\''.$_POST['userid'].'\' is already taken.';
   }
   if (strlen($_POST['userid'])<10) {
     $error[]='Student user id must be 10 character Like xx-xxxxx-x';
   }
    if (strlen($_POST['userid'])>10) {
     $error[]='Student user id must be 10 character Like xx-xxxxx-x';
   }
   if (preg_match("/\\s/",$_POST['userid'])==true) {
      $error[]='your userid must not contain a space';
   }
   if (strlen($_POST['password'])<6) {
     $error[]= 'Your password must be at least 6 characters';
   }
   if ($_POST['password']!== $_POST['passwordagain']) {
     $error[]='Your password do not match';
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
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>Student Registration</strong> </div>
                    </div>
                    <?php
                        if (isset($_GET['success'])&& empty($_GET['success'])) 
                        {
                         echo '<div class="alert alert-success">'.'<strong>'.'You have been registered succesfully'.'</strong>' .'</div>';
                        }else{
                        if (empty($_POST)===false && empty($error)===true) 
                        {
                            $register_data=array(
                              'userid'=>$_POST['userid'],
                              'username'=>$_POST['username'],
                              'password'=>$_POST['password'],
                              'active'=>$_POST['active']
                              );
                            register_student($register_data);
                            header('Location:studentreg.php?success');
                            exit();
                        }
                        else if (empty($error)===false) {
                          echo '<div class="alert alert-danger">'.'<strong>'. output_errors($error).'</strong>'. '</div>';
                        }
                        }
                    ?>

                    <div class="col-md-6" style="margin-left:250px; margin-top:50px;">
                        <form action="" method="POST">

                          <div class="form-group">
                            <label for="userid">User ID*:</label>
                            <input type="text" class="form-control" name="userid">
                          </div>

                           <div class="form-group">
                            <label for="username">User Name*:</label>
                            <input type="text" class="form-control" name="username">
                          </div>


                          <div class="form-group">
                            <label for="password">Password*:</label>
                            <input type="password" class="form-control" name="password">
                          </div>

                           <div class="form-group">
                            <label for="passwordagain">Password Again*:</label>
                            <input type="password" class="form-control" name="passwordagain">
                          </div>

                          <div class="form-group">
                            <label for="active">Active*:</label>
                            <input type="text" class="form-control" name="active">
                          </div>

                          
                          <input type="submit" value="Register" class="btn btn-primary">
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
