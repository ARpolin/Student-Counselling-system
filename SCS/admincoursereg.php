<?php
include 'core/init.php';
if(empty($_POST)===false)
{
  $required_fields=array('cname','cid','csec','ctime','ccredit','climit','csession');
  foreach ($_POST as $key => $value) {
    if (empty($value)&& in_array($value,$_POST)===true) 
    {
      $error[]="Field marked with an asterisk are required";
      break 1;
    }
  }
 if (empty($error)===true) {
    if (course_id_exists($_POST['cid']) === false && course_name_exists($_POST['cname']) === false) 
     {
        $error[]='Course Not exists';
     }

   if (strlen($_POST['cid'])<7) {
     $error[]='Course id must be 7 character';
   }
    if (strlen($_POST['cid'])>7) {
     $error[]='Course id must be 7 character';
   }

   if (strlen($_POST['csec'])<1) {
     $error[]='Sec must be 1 character';
   }
    if (strlen($_POST['csec'])>1) {
     $error[]='sec must be 1 character';
   }

    if (strlen($_POST['ccredit'])>5) {
     $error[]='Course credit must be 5 character.';
   }
   if (preg_match("/\\s/",$_POST['cid'])==true) {
      $error[]='your Course Id must not contain a space';
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
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> Offered Course Register </strong> </div>
                    </div>

                    

       
                    <div class="btn-group btn-group-justified">
                        <a href="admincourses.php" class="btn btn-primary">All courses</a>
                        <a href="adminfacultylist.php" class="btn btn-primary">Faculty List</a>
                        <a href="adminoffercourse.php" class="btn btn-primary">Offered Courses</a>
                        <a href="admincoursereg.php" class="btn btn-primary">Course Registration</a>
                    </div>
                    <br> 
                     <?php
                        if (isset($_GET['success'])&& empty($_GET['success'])) 
                        {
                            echo '<div class="alert alert-success">'.'<strong>'.'You have been registered succesfully'.'</strong>' .'</div>';
                        }
                        else{
                            if (empty($_POST)===false && empty($error)===true) 
                        {
                            $register_data=array(
                              'cid'=>$_POST['cid'],
                              'cname'=>$_POST['cname'],
                              'csec'=>$_POST['csec'],
                              'ctime'=>$_POST['ctime'],
                              'credit'=>$_POST['ccredit'],
                              'limit'=>$_POST['climit'],
                              'session'=>$_POST['csession']
                              );
                            course_register($register_data);
                            header('Location:admincoursereg.php?success');
                            exit();
                        }
                            else if (empty($error)===false) {
                                echo '<div class="alert alert-danger">'.'<strong>'. output_errors($error).'</strong>'. '</div>';
                            }
                        }
                    ?>
        
                   

                    <div class="col-md-12" style="background:#F9F4F3;">
                    	<div class="coursereg">
                    		<form action="" method="POST">
								<div class="form-group">
									<label for="coursename">Course Name:*</label>
								    <input type="text" class="form-control" name="cname">
								</div>

								<div class="form-group">
								    <label for="Courseid">Course ID:*</label>
								    <input type="text" class="form-control" name="cid">
								</div>

							  	<div class="form-group">
							    	<label for="sec">Sec:*</label>
							    	<input type="text" class="form-control" name="csec">
							  	</div>

							  	<div class="form-group">
							    	<label for="time">Time:*</label>
							   	 	<input type="text" class="form-control" name="ctime">
							  	</div>

							  	<div class="form-group">
							    	<label for="credit">Credit:*</label>
							   		<input type="text" class="form-control" name="ccredit">
							  	</div>

								<div class="form-group">
								    <label for="limit">Limit:*</label>
								    <input type="text" class="form-control" name="climit" value="40">
								</div>

                                <div class="form-group">
                                    <label for="limit">Session:*</label>
                                    <input type="text" class="form-control" name="csession">
                                </div>
								
								<button type="submit" class="btn btn-primary" style="margin-left:150px;width:220px; ">Submit</button>
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
