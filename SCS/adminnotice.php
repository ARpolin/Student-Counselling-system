<?php
include 'core/init.php';

if (empty($_POST)===false) {
    $require_field=array('title','notice');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($value,$_POST)===true) {
            $error[]='*Title and Notice Box must be required.';
            break 1;
        }
    }
    if (empty($error)===true) {
        if (strlen($_POST['title'])>60) {
            $error[]='Title must be required 55 charachters';
        }
        if (strlen($_POST['notice'])>300) {
            $error[]='Text content too long,content must be Required 300 character ';
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
    <script type="text/javascript">
    function post()
    {
        var notice = document.getElementById("notice").value;
        var title = document.getElementById("title").value;
        if(notice && title)
        {
            $.ajax
            ({
                type: 'post',
                url: 'postcomment.php',
                data: 
            {
         user_comm:notice,
         user_name:title
        },
        success: function (response) 
        {
            document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
            document.getElementById("notice").value="";
            document.getElementById("title").value="";
  
        }
        });
    }
  
    return false;
}
</script>

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
                    <div class="col-lg-12 col-md-offset overview">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>Notice Board</strong></div> 
                    </div>

                     <!--Notice add-->
                <?php
                if (isset($_GET['success'])&& empty($_GET['success'])) {
                    echo '<div class="alert alert-success">'.'<strong>'.'Successfully Send'.'</strong>' .'</div>';
                }
                else{
                    if (empty($_POST)===false && empty($error)===true) {
                        $Send_data=array(
                        'title'     =>$_POST['title'],
                        'notice'    =>$_POST['notice']
                        //'date'  =>date('Y-m-d H:m:s')
                    );
                        send_notice($Send_data);
                        header('Location:adminnotice.php?success');
                        exit();
                    }
                elseif (empty($error)===false) {
                    echo '<div class="alert alert-danger">'.'<strong>'. output_errors($error).'</strong>'. '</div>';            
                    }
                }   
                ?>

                    <div class="col-md-10" style="margin-left:70px;background: #f8fffe ;">
                        
                        <form action="" method="POST" onsubmit="return post();">
                            <div class="form-group col-md-6"> 
                                <label for="usr">Title:</label>
                                <input type="text" class="form-control" name="title" id="usr">
                            </div>

                            <div class="form-group col-md-10">
                                <label for="comment">Notice:</label>
                                <textarea class="form-control" rows="5" name="notice" id="comment"></textarea>
                            </div>

                            <div class="col-md-6 col-md-offset-8" >
                                <button type="submit" class="btn btn-primary" style="width:120px;">Post</button>
                            </div>
                        </form>
                    </div>
                    <br><br>

                    <div class="col-lg-12 overview" style="margin-top:20px;">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>All Notice</strong></div>  
                    </div>
                </div>

                  <!--All comments-->
                <div id="all_comments">
                  <?php
                    /*$row=Show_notice();
                        $title=$row['title'] ;
                        $notice=$row['notice'];
                        $time=$row['post_time'];*/

                    $result = Show_notice();
                    while($row=mysql_fetch_array($result))
                    {
                    $title=$row['title'];
                    $notice=$row['notice'];
                    $time=$row['post_time'];
                    ?>
              <div style="margin-top:50px;width:900px;margin-left:60px;"class="panel panel-info">

                  <div class="panel-heading"><h3 class="name">Title:<?php echo  $title;?></h3></div>
                  <div class="panel-body"><p class="comment"><?php echo $notice;?></p></div>
                  <div class="panel-body"> </div><p style="margin-left: 600px;" class="time">Published on: <?php echo $time;?></p>
                   <div class="col-md-2" style="margin-top:22px;">
                        <button type="submit" class="btn btn-primary" style="width:120px;">Delete</button>
                    </div>
                     <div class="col-md-2" style="margin-top:22px;">
                        <button type="submit" class="btn btn-primary" style="width:150px;"> Upload Document</button>
                    </div> 
                  </div>
                  <hr>
              </div>
                    <?php
                    }
                    ?>

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
