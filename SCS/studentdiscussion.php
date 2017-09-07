<?php
include 'core/init.php';

if (empty($_POST)===false) {
    $require_field=array('subject','description');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($value,$_POST)===true) {
            $error[]='*Subject and Description Box must be required.';
            break 1;
        }
    }
    if (empty($error)===true) {
        if (strlen($_POST['subject'])>60) {
            $error[]='Subject must be required 55 charachters';
        }
        if (strlen($_POST['description'])>500) {
            $error[]='Text content too long,content must be Required 500 character ';
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

    <title>Student Counselling system</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <!--style CSS-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
            document.getElementById("description").value="";
            document.getElementById("subject").value="";
  
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
                    
                    <div class="col-lg-12 col-md-offset overview">

                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>Discussion</strong></div> 
                    </div>
                    <br>
                          <!--Notice add-->
                <?php
                if (isset($_GET['success'])&& empty($_GET['success'])) {
                    echo '<div class="alert alert-success">'.'<strong>'.'Successfully Send'.'</strong>' .'</div>';
                }
                else{
                    if (empty($_POST)===false && empty($error)===true) {
                        $Send_data=array(
                        'subject'     =>$_POST['subject'],
                        'description'    =>$_POST['description']
                        //'date'  =>date('Y-m-d H:m:s')
                    );
                        send_discussion($Send_data);
                        header('Location:studentdiscussion.php?success');
                        exit();
                    }
                elseif (empty($error)===false) {
                    echo '<div class="alert alert-danger">'.'<strong>'. output_errors($error).'</strong>'. '</div>';            
                    }
                }   
                ?>
                <p style="color:red; text-align:center;"><strong>"Please dont' give any personal details and informaton like Phone number or Email" </strong></p>
                    <div class="col-md-10" style="margin-left:70px;background: #f8fffe ;">
                        
                        <form action="" method="POST" onsubmit="return post();">
                            <div class="form-group col-md-6"> 
                                <label for="usr">Subject:</label>
                                <input type="text" class="form-control" name="subject" id="usr">
                            </div>

                            <div class="form-group col-md-10">
                                <label for="comment">Problem Description:</label>
                                <textarea class="form-control" rows="5" name="description" id="comment"></textarea>
                            </div>

                            <div class="col-md-6 col-md-offset-8" >
                                <button type="submit" class="btn btn-primary" style="width:120px;">Post</button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <br>
                    <div class="col-lg-4 overview" style="margin-top:20px;">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>All Problem</strong></div>  
                    </div>

                </div>
                 <!--All comments-->
                <div id="all_comments">
                  <?php
                    /*$row=Show_notice();
                        $title=$row['title'] ;
                        $notice=$row['notice'];
                        $time=$row['post_time'];*/

                    $result = Show_discussion();
                    while($row=mysql_fetch_array($result))
                    {
                    $subject=$row['subject'];
                    $description=$row['description'];
                    $time=$row['post_time'];
                    ?>

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height:90px;">
                            <div style="margin-left:10px;">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1">
                                    <p><strong>Subject:</strong> <?php echo  $subject;?></p>
                                </a>
                                </h4>
                            </div>

                            <div style="">
                                <div class="col-md-6" style="height:40px;">
                                    <p style="" class="time">Published on: <?php echo $time;?></p>
                                </div>
                                <div class="col-md-6 stars"style="height:40px;float:right;" >
                                    <form action="">
                                        <input class="star star-5" id="star-5" type="radio" name="star"/>
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star"/>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star"/>
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star"/>
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star"/>
                                        <label class="star star-1" for="star-1"></label>
                                    </form>
                                </div>
                            </div>             
                        </div>

                        


                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body"><?php echo $description;?></div>            
                            <div class="panel-body">
                                <p>All replay</p>
                            </div>
                            <div class="panel-footer"><input type="button" class="btn btn-primary" value="Replay" data-toggle="modal" data-target="#myModal"></div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    ?>
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
                    <h4 class="modal-title">Replay Section</h4>
                </div>
                <div class="modal-body">
                
                    <label for="replay">Problem Description:</label>
                    <textarea class="form-control" rows="5" name="replay" id="comment"></textarea>
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
