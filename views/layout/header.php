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
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery.noty.packaged.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!--    <link rel="stylesheet" href="../css/easydropdown.css"/>-->

    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }


        .icon-bar {
            width: 100%;
            text-align: center;
            background-color: #555;
            overflow: auto;
        }

        .icon-bar a {
            width: 20%;
            padding: 7px 0;
            float: left;
            transition: all 0.3s ease;
            color: white;
            font-size: 20px;
        }

        .icon-bar a:hover {
            background-color: #000;
        }

        .active {
            background-color: #4CAF50;
        }
    </style>
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
                        <label for="class">Class: </label>
                        <select class="form-control">
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="section">Section: </label>
                        <select class="form-control">
                            <option value="">A</option>
                            <option value="">B</option>
                            <option value="">C</option>
                            <option value="">D</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="routine">Routine: </label>
                        <input type="file" name="file"/>
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
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
                            <option value="">Class 1</option>
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
                <ul class="dropdown-menu multi-level">
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class 1</a>
                        <ul class="dropdown-menu">
                            <li><a href="routine.php">Section A</a></li>
                            <li><a href="routine.php">Section B</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class 2</a>
                        <ul class="dropdown-menu">
                            <li><a href="routine.php">Section A</a></li>
                            <li><a href="routine.php">Section B</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class 3</a>
                        <ul class="dropdown-menu">
                            <li><a href="routine.php">Section A</a></li>
                            <li><a href="routine.php">Section B</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class 4</a>
                        <ul class="dropdown-menu">
                            <li><a href="routine.php">Section A</a></li>
                            <li><a href="routine.php">Section B</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class 5</a>
                        <ul class="dropdown-menu">
                            <li><a href="../routine.php">Section A</a></li>
                            <li><a href="../routine.php">Section B</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="a_fee.php">Fee</a></li>
            <li class="dropdown">
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

                    <a href="#">
                        <div class="col-md-12" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #47666b;">
                                <div>Teacher</div>
                            </div>
                        </div>
                    </a>

                    <a href="routine.php">
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
            </li>
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