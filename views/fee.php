<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 6:39 PM
 */
session_start();
if($_SESSION['role'] != 'Receptionist'){
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>

</head>
<body>
<?php include 'layout/header.php' ?>

<!--update fee Modal -->
<div id="updateFeeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Fee</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/feeController.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="mode" value="update">
                    <input type="hidden" name="class_id" value="<?php echo $_GET['id'] ?>" >

                    <div class="form-group">
                        <label for="class">Fee Photo: </label>
                        <input type="file" name="fee_photo" required=""/>
                    </div>

                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Update Fee</button>
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


    $class = getAllFee($connection);
    ?>
        <?php
        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
            ?>
            <span class="btn btn-success pull-right" data-toggle="modal" data-target="#feeModal"><i class="glyphicon glyphicon-upload"> Update</i></span>
            <?php
        }
        ?>
    <table class="table table-responsive table-bordered">
        <thead>
        <th>Class</th>
        <th>Total Fee</th>
        </thead>
        <?php
        while($row = $class->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo getClassName($row['class_id'], $connection); ?></td>
                <td><?php echo $row['total']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

</div>

</body>
</html>
<?php
}else{
    header('Location: logout.php');
}
?>