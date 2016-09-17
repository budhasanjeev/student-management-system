<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 6:39 PM
 */
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Upload Sheet</title>

</head>
<body>
<div class="container">
    <?php include 'layout/header.php' ?>


    <form action="../controller/feeController.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="upload">
    </form>


    <legend>Upload fee file</legend>
    <div class="col-xs-8 col-xs-offset-2">
        <div class="input-group">
            <div class="input-group-btn search-panel">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span id="search_concept">Select Class</span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#contains">Class 1</a></li>
                    <li><a href="#contains">Class 2</a></li>
                    <li><a href="#contains">Class 3</a></li>
                    <li><a href="#contains">Class 4</a></li>
                    <li><a href="#contains">Class 5</a></li>
                    <li><a href="#contains">Class 6</a></li>
                    <li><a href="#contains">Class 7</a></li>
                    <li><a href="#contains">Class 8</a></li>
                    <li><a href="#contains">Class 9</a></li>
                    <li><a href="#contains">Class 10</a></li>
                </ul>
            </div>
            <input type="hidden" name="search_param" value="all" id="search_param">
            <input type="file" class="btn btn-default  form-control" name="x" placeholder="Upload Excell File">
            <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-upload"></span>
                    </button>
                </span>
        </div>
    </div>

    <legend>fee</legend>
    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 1</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 2</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 3</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 4</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 5</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 6<h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 7</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Class 8</h4>
            </div>
        </div>
    </a>

</div>


</body>
</html>
