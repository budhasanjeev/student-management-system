<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 6:39 PM
 */
include '../common/Common.php';
include '../config/databaseConnection.php';
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>

</head>
<body>
<?php include 'layout/header.php' ?>


<!---->
<!--<div class="col-xs-8 col-xs-offset-2">-->
<!--    <div class="input-group">-->
<!--        <div class="input-group-btn search-panel">-->
<!--            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">-->
<!--                <span id="search_concept">Filter by</span> <span class="caret"></span>-->
<!--            </button>-->
<!--            <ul class="dropdown-menu" role="menu">-->
<!--                <li><a href="#contains">Contains</a></li>-->
<!--                <li><a href="#its_equal">It's equal</a></li>-->
<!--                <li><a href="#greather_than">Greather than ></a></li>-->
<!--                <li><a href="#less_than">Less than < </a></li>-->
<!--                <li class="divider"></li>-->
<!--                <li><a href="#all">Anything</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <input type="hidden" name="search_param" value="all" id="search_param">-->
<!--        <input type="text" class="form-control" name="x" placeholder="Search term...">-->
<!--                <span class="input-group-btn">-->
<!--                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span>-->
<!--                    </button>-->
<!--                </span>-->
<!--    </div>-->
<!--</div>-->
<!--<form action="../controller/routineController.php" method="post" enctype="multipart/form-data">-->
<!--    Grade <input type="text" name="grade">-->
<!--    <input type="file" name="file" />-->
<!--    <button type="submit" name="btn-upload">upload</button>-->
<!--</form>-->

<div class="container">
    <?php
    $class_id = $_GET["id"];
    include "../config/databaseConnection.php";
    //$class = getClassName($id, $connection);
    ?>
<!--    //<legend>Routine of Class --><?php //echo $class; ?><!--</legend>-->
    <?php
    $objCommon = new Common();
    $routine = $objCommon->getRoutine($class_id);
    echo $routine;
    ?>

    <tr>
        <td style="vertical-align: middle"><img src="../img/<?php echo $routine ?>"
                                                 style="width:inherit
"></td>

        </td>
    </tr>





</div>

</body>
</html>