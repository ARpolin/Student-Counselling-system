<?php 
include 'core/init.php';

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
                    <div class="col-lg-12">
                        <div class="well well-sm" style="text-align:center;background:#09bfe0;"><strong>Upload Notes </strong> </div>
                    </div>
                    <div class="upload">
                        <?php
                        if (isset($_FILES['upload'])===true) {
                                if (empty($_FILES['upload']['name'])===true) {
                                    echo 'Please Choose a file';
                                }
                                else
                                {
                                    $allowed=array('txt', 'pdf', 'doc', 'docx');
                                    $name=$_FILES['upload']['name'];
                                    $file_extn=strtolower(end(explode('.', $name)));
                                    $tmpname=$_FILES['upload']['tmp_name'];
                                    $size=$_FILES['upload']['size'];
                                    $type=$_FILES['upload']['type'];
                                    $upload_data=array(
                                        'name'=> $_FILES['upload']['name'],
                                        'size'=>$_FILES['upload']['size'],
                                        'type'=>$_FILES['upload']['type'],
                                        'usersessoin'=> $fuserdata['userid']
                                        );

                                    if (in_array($file_extn,$allowed)===true) {
                                        Insert_files($upload_data,$file_extn,$tmpname);
                                        upload_files($fuserdata['userid'],$tmpname,$file_extn);
                                        echo 'Succesfully uploaded';
                                        //upload_files($fuserdata['userid'],$tmpname,$file_extn);
                                    }
                                    else
                                    {
                                        echo 'Incorrect file type.Allowed:';
                                        echo implode(', ', $allowed);
                                    }
                                }
                            }
                        ?>
                    <br>
                    </div>

                    <div style="margin-left:15px;">
                        <h4>Select Your File Here:</h4>
                    </div>

                    <div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-3">
                                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                <input type="file" class="btn btn-default" name="upload">
                            </div>
                            <div class="col-md-6" style="margin-left:20px; margin-top:4px;">
                                <input type="submit" class="btn btn-primary" name="upload" value="Upload">
                            </div>   
                        </form>
                    </div>
                    <br><br>

                    <div class="col-md-12">
                        <h4>All Files</h4>         
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Type</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $faculty_session= $fuserdata['userid'];
                            $result = get_notes($faculty_session);
                            while($row=mysql_fetch_array($result))
                            {
                                $id=$row['id'];
                                $filename=$row['name'];
                                $size=$row['size'];
                                $type=$row['type'];
                                $session=$row['usersessoin'];
                                echo '<tr>';
                                echo '<td><strong><a href="?msg='.$id.'">' .$filename. '</a></strong></td>';
                                echo '<td><strong><a href="?msg='.$id.'">' .$size. '</a></strong></td>';
                                echo '<td><strong><a href="?msg='.$id.'">' .$type. '</a></strong></td>';
                                echo '<td><strong><a href="?msg='.$id.'">' .$session. '</a></strong></td>';
                                echo '<form action=\"\" method=\"POST\">';
                                echo "<td>
                                      <a href=".$row["path"].">
                                      <input type=\"button\" value=\" Download\" class=\"btn btn-primary\">
                                        <input type=\"button\" value=\" Delete\" class=\"btn btn-primary\" onClick=\"return confirm('Are you sure you want to delete?')\">
                                      </a>  
                                </td>";
                                echo '</form>';
                            }
                            ?>
                            </tbody>
                        </table> 
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
