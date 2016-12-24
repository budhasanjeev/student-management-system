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
    $class_id = $_GET["id"];

    $class = getClassName($class_id, $connection);
    ?>
    <legend>Fee of Class <?php echo $class; ?>
        <?php
        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
            ?>
            <span class="btn btn-success pull-right" data-toggle="modal" data-target="#updateFeeModal"><i class="glyphicon glyphicon-upload"> Update</i></span>
            <?php
        }
        ?>
        </legend>
    <?php
    $objCommon = new Common();
    $fee = $objCommon->getFee($class_id);
//    print_r("asdf");
//    print_r($fee);


    ?>
    <embed src="../img/<?php echo $fee ?>" style="width: 100% !important; height: 100%"></embed>

</div>

</body>
</html>
<?php
}else{
    header('Location: logout.php');
}
?>