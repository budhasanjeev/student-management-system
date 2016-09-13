<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 1:33 PM
 */
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../../js/jquery-1.12.4.min.js"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/style.css"/>
    <style>
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
<nav class="navbar" role="navigation" style="border-radius: 0px; border-bottom: 2px solid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add New<b class="caret"></b></a>

                <div class="dropdown-menu ">
                    <a href="../user.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #47666b;">
                                <div>User</div>
                            </div>
                        </div>
                    </a>

                    <a href="../student.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #aba992;">
                                <div>Student</div>
                            </div>
                        </div>
                    </a>

                    <a href="../admin/routine.php.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #533443;">
                                <div>Routine</div>
                            </div>
                        </div>
                    </a>

                    <a href="../fee.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #a07789;">
                                <div>Fee</div>
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
                    <li><a href="">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<div style="height: 50px;"></div>
</body>
</html>