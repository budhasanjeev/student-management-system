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

<!--update Routine Modal -->
<div id="updateRoutineModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Routine</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/routineController.php" method="post">

                    <input type="hidden" name="update" value="update">
                    <input type="hidden" name="class_id" value="<?php echo $_GET['id'] ?> ">

                    <div class="form-group">
                        <label for="class">Routine Photo: </label>
                        <input type="file" name="routine_photo" required=""/>
                    </div>

                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Update Routine</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div class="container">
    <?php
    $class_id = $_GET["id"];
    $class = getClassName($class_id, $connection);
    ?>
        <legend>Routine of Class <?php echo $class; ?><span class="btn btn-success pull-right" data-toggle="modal" data-target="#updateRoutineModal"><i class="glyphicon glyphicon-update"> Update</i></span></legend>
    <?php
    $objCommon = new Common();
    $routine = $objCommon->getRoutine($class_id);
    ?>

<img src="../img/<?php echo $routine['file'] ?>"style="width:inherit">


</div>

</body>
</html>