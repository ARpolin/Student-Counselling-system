<?php 
include 'core/init.php';

if (empty(Input::exists()) === false) {
    $userid= Input::get ('userid');
    $password= Input::get('password');
    //echo $userid,  ''  ,$password;

    if (empty($userid)===true || empty($password)===true)
     {
        $error[]='You need to Enter your User ID and Password';
     } 
     else if (admin_userid_exists($userid) === false && facultyuserid_exists($userid) === false && studentuserid_exists($userid)===false) 
     {
        $error[]='We couldnt find the users can you register?' ;
     }
     else if (admin_userid_active($userid) === false && facultyuserid_active($userid) === false && studentuserid_exists($userid)===false) 
     {
        $error[]='Not activated your account';
     }
     else
     {
        //$adminlogin= adminlogin($userid,$password);
        $adminlogin='';
        $admin='xxx-xxxxxx-xxx';
        if (strlen($userid)==strlen($admin)) {
            $adminlogin= adminlogin($userid,$password);
        }
        if ($adminlogin===false) 
        {
            $error[]='Incorrect Username and Password';
        }
        else
        {
            if ($adminlogin) {
                $_SESSION['id']=$adminlogin;
                header('Location:AdminProfile.php'); 
            }
            
        }
        $facultylogin='';
        $faculty='xx-xxxxxx-x';
        if (strlen($userid)==strlen($faculty)) {
            $facultylogin= facultylogin($userid,$password);
        }
        if ($facultylogin===false) 
        {
            $error[]='Incorrect Username and Password';
        }
        else
        {
            if ($facultylogin) {
                $_SESSION['id']=$facultylogin;
                header('Location:facultyprofile.php'); 
            }
            
        }
        $studentlogin='';
        $student='xx-xxxxx-x';
        if (strlen($userid)==strlen($student)) {
            $studentlogin= studentlogin($userid,$password);
        }
        if ($studentlogin===false) 
        {
            $error[]='Incorrect Username and Password';
        }
        else
        {
            if ($studentlogin) {
                $_SESSION['id']=$studentlogin;
                header('Location:studentprofile.php'); 
            }
            
        }
     }
     //print_r($error);
    }else
    {
        $error[]='Please Provide Your User ID and Password';
    }
//echo output_errors($error);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Counselling</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/half-slider.css" rel="stylesheet">
</head>

<body background="img/logformback.jpg">

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6" style="margin-left:300px">
            <!--Login form start-->
                <div style="margin-top:200px">
                    <h4 style="color:#FFFFFF">Log In</h4>
                    <p>
                    <?php 
                    echo '<font color="red">'. output_errors($error) .'</font>';
                    ?>
                    </p>
                </div>
            
                <form role="form" action="" method="POST">
                    <div class="form-group">
                        <SPAN class="glyphicon glyphicon-user"></SPAN>
                        <label for="email"style="color:#FFFFFF">UserID:</label>
                        <input type="text" class="form-control" name="userid" id="userid" placeholder="Enter userID">
                         
                    </div>
                    <div class="form-group">
                        <label for="pwd"style="color:#FFFFFF">Password:</label>
                        <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox"style="color:#FFFFFF"> Remember me</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default col-sm-12" style="background:#FF4C00">
                        <SPAN class="glyphicon glyphicon-ok-circle"></SPAN> Submit
                        </button>
                    </div>
                </form>
            <!--Login End-->
            </div>
        </div>
      

        <!-- Footer -->
        <footer>
            <div class="row">
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
