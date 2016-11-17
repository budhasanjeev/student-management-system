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
    <title>Student Management</title>

</head>
<body>
<?php include 'layout/header.php' ?>

<div class="container">
    <?php
    $class_id = $_GET["id"];
    $class = getClassName($class_id, $connection);
    ?>
        <legend>Routine of Class <?php echo $class; ?><span class="btn btn-danger pull-right"><i class="glyphicon glyphicon-trash"> Delete</i></span></legend>
    <?php
    $objCommon = new Common();
    $routine = $objCommon->getRoutine($class_id);
    echo $routine;
    ?>

<img src="../img/<?php echo $routine ?>"style="width:inherit">


</div>

</body>
</html>