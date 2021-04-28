<?php
session_start();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>The Kitchen</title>
        <!-- Bootstrap Styles-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FontAwesome Styles-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="settings1.php">MAIN MENU </a>
                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="usersettings1.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="settings1.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout1.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>

                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </nav>
            <!--/. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">

                        <li>
                            <a class="active-menu" href="settings1.php"><i class="fa fa-dashboard"></i>User Dashboard</a>
                        </li>  
                </div>
            </nav>
            <!-- /. NAV SIDE  -->

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                ADMINISTRATOR<small> accounts </small>
                            </h1>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>User name</th>
                                                    <th>Password</th>

                                                    <th>Update</th>
                                                    <th>Remove</th>

                                                </tr>
                                            </thead>
                                            <tbody>

        <?php
        
        require '../credentials.php';
        
       
        
        $querys = "SELECT * FROM kitchen";
        $result = mysqli_query($conn,$querys) or die(mysqli_error());
        while ($row = mysqli_fetch_array($result))
        {
            $id = $row["id"];
            $us = $row["uname"];
            $ps = $row["pass"];
            if ($id % 2 == 0)
            {
                echo "<tr class='gradeC'>
                        <td>" . $id . "</td>
                        <td>" . $us . "</td>
			            <td>" . $ps . "</td>
                        <td><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'> Update </button></td>
                        <td><a href=usersettingsdel1.php?eid=" . $id . " <button class='btn btn-danger'> <i class='fa fa-edit' ></i> Delete</button></td>
                      </tr>";
            }
            else
            {
                echo "<tr class='gradeU'>
                        <td>" . $id . "</td>
			            <td>" . $us . "</td>
			            <td>" . $ps . "</td>
                        <td><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>Update</button></td>
                        <td><a href=usersettingsdel1.php?eid=" . $id . " <button class='btn btn-danger'> <i class='fa fa-edit' ></i> Delete</button></td>
                      </tr>";
            }
        }
        ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                            <div class="panel-body">
                                <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModalins">
                                    Add New Admin
                                </button>
                                <div class="modal fade" id="myModalins" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Add the User name and Password</h4>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Add new User name</label>
                                                        <input name="newun"  class="form-control" placeholder="Enter User name">
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input name="newps"  class="form-control" placeholder="Enter Password">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                    <input type="submit" name="ad" value="Add" class="btn btn-primary">
                                                        </form>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php

require '../credentials.php';
        

if (isset($_POST["ad"])) 
{
    $unam = $_POST["newun"];
    $passd = $_POST["newps"];
    $query = "INSERT into kitchen(uname,pass)VALUES('$unam','$passd')";
    if (mysqli_query($conn,$query)or die(mysqli_error()))
    {
        echo' <script language="javascript" type="text/javascript"> alert("User name and password Added") </script>';
        mysqli_close($conn);
    }
    echo '<meta http-equiv="refresh" content="1; URL=usersettings1.php" />';
}
mysqli_close($conn);
?>

                            <div class="panel-body">

                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Change the User name and Password</h4>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Change User name</label>
                                                        <input name="uname" value="<?php echo $us; ?>" class="form-control" placeholder="Enter User name">
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Change Password</label>
                                                        <input name="pass" value="<?php echo $ps; ?>" class="form-control" placeholder="Enter Password">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                    <input type="submit" name="upd" value="Update" class="btn btn-primary">
                                                        </form>

                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /. ROW  -->
<?php
require '../credentials.php';
        

if (isset($_POST["upd"])) 
{    
    $una = $_POST["uname"];
    $pasw = $_POST["pass"];
    $query = "UPDATE kitchen SET uname = '$una', pass = '$pasw' WHERE id = '$id'";
    if (mysqli_query($conn,$query)or die(mysqli_error()))
    {
        echo' <script language="javascript" type="text/javascript"> alert("User name and password Updated") </script>';
        mysqli_close($conn);
    }
    echo '<meta http-equiv="refresh" content="1; URL=usersettings1.php" />';
}
ob_end_flush();
?>
                    <!-- /. PAGE INNER  -->
                </div>
                <!-- /. PAGE WRAPPER  -->
            </div>
            <!-- /. WRAPPER  -->
            <!-- JS Scripts-->
            <!-- jQuery Js -->
            <script src="assets/js/jquery-1.10.2.js"></script>
            <!-- Bootstrap Js -->
            <script src="assets/js/bootstrap.min.js"></script>
            <!-- Metis Menu Js -->
            <script src="assets/js/jquery.metisMenu.js"></script>
            <!-- Custom Js -->
            <script src="assets/js/custom-scripts.js"></script>

    </body>
</html>


