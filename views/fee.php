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


<div class="container">
    <?php
    $class_id = $_GET["id"];

    include "../config/databaseConnection.php";
    //$class = getClassName($id, $connection);
    ?>
    <!--    //<legend>Routine of Class --><?php //echo $class; ?><!--</legend>-->
    <?php
    $objCommon = new Common();
    $fee = $objCommon->getFee($class_id);
    echo $fee;
    ?>

    <tr>
        <td style="vertical-align: middle"><img src="../img/<?php echo $fee ?>"
                                                style="width:inherit
"></td>

        </td>
    </tr>





</div>

</body>
</html>