<?php
include 'core/init.php';

if(empty($_POST)===false)
{
  $required_fields=array('from','to','username','subject','message');
  foreach ($_POST as $key => $value) {
    if (empty($value)&& in_array($value,$_POST)===true) 
    {
      $error[]="Field marked with an asterisk are required";
      break 1;
    }
  }
 if (empty($error)===true) {

    if (admin_userid_exists($_POST['from']) === false && facultyuserid_exists($_POST['to']) === false) 
    {
        $error[]='could not find the users?Please Enter a Valid Userid';
    }

    if (strlen($_POST['from'])<14) {
     $error[]='Admin user id must be 14 character Like xxx-xxxxxx-xxx';
   }
   if (strlen($_POST['from'])>14) {
     $error[]='Admin user id must be 14 character Like xxx-xxxxxx-xxx';
   }
   if (strlen($_POST['to'])<11) {
     $error[]='Faculty user id must be 11 character Like xx-xxxxxx-x';
   }
    if (strlen($_POST['to'])>11) {
     $error[]='Faculty user id must be 11 character Like xx-xxxxxx-x';
   }
   if (admin_username_exists($_POST['username']) === false) 
    {
        $error[]='could not find the Admin Username?Please Enter a Valid Username';
    }

   if (preg_match("/\\s/",$_POST['to'])==true) {
      $error[]='your userid must not contain a space';
   }
    if (preg_match("/\\s/",$_POST['from'])==true) {
      $error[]='your userid must not contain a space';
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
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong> Inbox </strong> </div>
                    </div>
                    <br>
                    <br>
                     <?php
                        if (isset($_GET['msg'])) {
                            $id=$_GET['msg'];
                            //$update=mysql_query("UPDATE `inbox` SET open='1'");
                            $update=update_inbox();
                            //$msgres=mysql_query("SELECT * FROM `inbox` WHERE `id`= '$id'");
                            $msgres=get_massage($id);
                            $row=mysql_fetch_assoc($msgres);

                            $from=$row['from'];
                            $to=$row['to'];
                            $name=$row['name'];
                            $subject=$row['subject'];
                            $message=$row['message'];
                            $date=$row['date'];
                    ?>
                    <div id="msg"  class="col-md-12" style="margin-top:10px;">
                        <table class="table" style="background: #4fcdf0 ;">
                            <tr>
                                <td><strong> From:  <?php echo $from;?></strong> </td>
                                <td><strong> To: <?php echo $to;?> </strong></td>
                                <td><strong> Username: <?php echo $name;?> </strong></td>
                                <td><strong> Subject: <?php echo $subject;?> </strong></td>
                                <td><strong> Date: <?php echo $date;?></strong> </td>
                            </tr>
                        </table>
                        <pre style="background: #f9fce2;"><?php echo $message;?></pre>
                        
                        <a href="?remove=<?php echo $id;?>" style="color:black;">
                            <button class="btn btn-primary">Delete Message</button>
                        </a>
                        <a href="admininbox.php" style="color:black;">
                            <button class="btn btn-primary">Back</button>
                        </a>        
                            
                            
    
                        
                    </div>

                    <?php exit();}?>

                    <?php
                    if (isset($_GET['remove'])) {
                        $id=$_GET['remove'];
                        //$remove=mysql_query("DELETE FROM `inbox` WHERE `id`='$id'");
                        $remove=delete_massage($id);
                        if ($remove) {
                            header('Location:admininbox.php'); 
                        }
                        else
                        {
                            die("Please Refresh the Page");
                        }
                    }
                    ?>
                    <div class="col-md-12 col-md-offset-10">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Compose Message</button>
                    </div>

                   <div class="col-md-12" style="margin-top:10px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Seen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               
                            error_reporting(0);
                            $page=$_GET['page'];
                            if ($page=="" || $page=="1") {
                                $page1=0;
                            }
                            else
                            {
                                $page1=($page*7)-7;
                            }  
                                $admin_session= $userdata['userid'];
                                //echo $admin_session;
                                $result = All_inbox($page1,$admin_session);
                                echo $result;
                                //Fetch All Value.
                                while($row=mysql_fetch_array($result))
                                {
                                    $to=$row['to'];
                                    $id=$row['id'];
                                    $from=$row['from'];
                                    $name=$row['name'];
                                    $subject=$row['subject'];
                                    $message=$row['message'];
                                    $date=$row['date'];
                                    if ($row['open']==0) {
                                        $open='Not Open';
                                    }
                                    else
                                    {
                                        $open='Open';
                                    }
                                    echo "<tr>";
                                    //echo '<td><strong><a href="?msg='.$id.'">' .$id. '</a></strong></td>';
                                    echo '<td><strong><a href="?msg='.$id.'">' .$to. '</a></strong></td>';
                                    echo '<td><strong><a href="?msg='.$id.'">' .$name. '</a></strong></td>';
                                    echo '<td><strong><a href="?msg='.$id.'">' .$subject. '</a></strong></td>';
                                    echo '<td><strong><a href="?msg='.$id.'">' .$date. '</a></strong></td>';
                                    echo '<td><strong><a href="?msg='.$id.'">' .$open. '</a></strong></td>';
                                  }  
                          
                                ?>      
                        </tbody>
                    </table>
                </div>  

                  <div>
                    <!--Pagging-->
                    <div class="col-md-10">
                        <ul class="pagination" style="width:200px;">    
                    <?php
                       $allpage=all_inbox_paging();
                       $result1=mysql_num_rows($allpage);
                       $count=$result1/7;
                       $cell=ceil($count);
                       for($pagecount=1;$pagecount<=$cell;$pagecount++)
                       {
                         ?><li><a href="admininbox.php?page=<?php echo $pagecount;?>"><?php echo $pagecount; ?></a></li><?php
                       }
                    ?> 
                        </ul>
                    </div>
                </div>       
 


                

                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:background:#09bfe0;">Compose Message</h4>
      </div>

      <div class="modal-body col-md-12">
        
      <!--Inbox form-->
                    <?php
                        if (isset($_GET['success'])&& empty($_GET['success'])) 
                        {
                            echo '<div class="alert alert-success">'.'<strong>'.'You have been registered succesfully'.'</strong>' .'</div>';
                        }
                        else{
                            if (empty($_POST)===false && empty($error)===true) 
                        {
                            $message_data=array(
                              'from'=>$_POST['from'],
                              'to'=>$_POST['to'],
                              'name'=>$_POST['username'],
                              'subject'=>$_POST['subject'],
                              'message'=>$_POST['message'],
                               //$open => 0
                              );
                           
                            send_message($message_data);
                            header('Location:admininbox.php?success');
                            exit();
                        }
                            else if (empty($error)===false) {
                                echo '<div class="alert alert-danger">'.'<strong>'. output_errors($error).'</strong>'. '</div>';
                            }
                        }
                    ?>
                    <div class="col-md-10" style="margin-left:50px;">
                        <form action="" method="POST">

                         <div class="form-group">
                            <label for="userid">From*:</label>
                            <input type="text" class="form-control" name="from">
                        </div>

                        <div class="form-group">
                            <label for="userid">To*:</label>
                            <input type="text" class="form-control" name="to">
                        </div>


                        <div class="form-group">
                            <label for="username">UserName*:</label>
                            <input type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="username">Subject*:</label>
                            <input type="text" class="form-control" name="subject">
                        </div>

                        <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" rows="5" name="message" id="comment"></textarea>
                        </div>

                        <div class="col-md-6">
                            <input type="submit" value="Send Message" class="btn btn-primary">
                        </div>  
                          
                        </form>
                    </div>
                    <!--Inbox form-->




      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
