<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 1:33 PM
 */

session_start();
if(!isset($_SESSION["email"])){
    header("Location: login.php");
}

include "../config/databaseConnection.php";
include "../common/service.php";
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery.noty.packaged.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/custom.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../css/easydropdown.css"/>

</head>
<body>

<!--Routine Modal -->
<div id="routineModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new Routine</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/routineController.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="class" name="class">Class: </label>
                        <select name="class_id" class="form-control" onchange="setTextField()">
                            <?php
                            $class = getClass($connection);
                            while($row = $class->fetch_assoc()){
                                ?>

                                <option  value="<?php echo $row["id"]; ?>"><?php echo $row["class"]; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                        <input id="class" type = "hidden" name = "class" value = "" />
                        <script type="text/javascript">
                            function setTextField(ddl) {
                                document.getElementById('class').value = ddl.options[ddl.selectedIndex].text;
                            }
                        </script>

                    </div>

                    <div class="form-group">
                        <label for="routine">Routine: </label>
                        <input type="file" name="file"/>
                    </div>
                    <div style="text-align: right">
                        <input type="submit" value="submit" name="submit"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!--Fee Modal -->
<div id="feeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Fee</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="class">Class: </label>
                        <select class="form-control">
                            <?php
                            $class = getClass($connection);
                            while($row = $class->fetch_assoc()){
                                ?>
                                <option value="<?php echo $row["class"]; ?>"><?php echo $row["class"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="routine">Fee: </label>
                        <input type="file"/>
                    </div>
                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Class Modal -->
<div id="classModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Class</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/addClass.php" method="post">
                    <div class="form-group">
                        <label for="class">Class: </label>
                        <input class="form-control" type="text" name="class" required=""/>
                    </div>
                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!--Add Teacher Modal -->
<div id="teacherModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Teacher</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/teacherController.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="mode" value="add">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class">Name: </label>
                            <input class="form-control" type="text" name="name" required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Contact: </label>
                            <input class="form-control" placeholder="98********, 98********" type="text" name="contact" required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Email: </label>
                            <input class="form-control" type="email" name="email"/>
                        </div>

                        <div class="form-group">
                            <label for="class">Experience: </label>
                            <input class="form-control" type="text" name="experience" required=""/>
                        </div>


                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="class">Username: </label>
                            <input class="form-control" type="text" name="username" required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Address: </label>
                            <input class="form-control" type="text" name="address" required=""/>
                        </div>


                        <div class="form-group">
                            <label for="class">Degree: </label>
                            <input class="form-control" type="text" name="degree" required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Joined on: </label>
                            <input class="form-control" type="date" name="join_on" required=""/>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="class">Photo: </label>
                        <input type="file" name="photo" required=""/>
                    </div>

                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<nav class="navbar" role="navigation" style="border-radius: 0px; border-bottom: 2px solid #a07789">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="admin.php">SMS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="a_class.php">Students</a></li>
            <li><a href="a_teacher.php">Teachers</a></li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Routine<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    $class = getClass($connection);
                    while($row = $class->fetch_assoc()) {
                        ?>
                        <li>
                            <a href="routine.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <?php
                if($_SESSION['role'] == 'Admin'){
                    echo '<li><a href="a_fee.php">Fee</a></li>';
                    echo '<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add New<b class="caret"></b></a>

                <div class="dropdown-menu" style="padding: 4px;">
                    <a href="a_user.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #a07789;">
                                <div>User</div>
                            </div>
                        </div>
                    </a>

                    <a href="student.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #aba992;">
                                <div>Student</div>
                            </div>
                        </div>
                    </a>

                    <a href="">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #47666b;">
                                <a href="" data-toggle="modal" data-target="#teacherModal"><div>Teacher</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #533443;">
                                <a href="" data-toggle="modal" data-target="#classModal"><div>Class</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #533443;">
                                <a href="" data-toggle="modal" data-target="#routineModal"><div>Routine</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="a_fee.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #a07789;">
                                <a href=""  data-toggle="modal" data-target="#feeModal"><div>Fee</div></a>
                            </div>
                        </div>
                    </a>
                </div>
            </li>';
                }

            if($_SESSION['role'] == 'teacher'){
                echo '<li><a href="t_marks.php">Marks</a></li>';
            }
            ?>

        </ul>
        <div class="col-sm-3 col-md-3">
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">

                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">H! User<b class="caret"></b></a>

                <ul class="dropdown-menu ">
                    <li><a href="">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<div style="height: 50px;"></div>
</body>
</html>