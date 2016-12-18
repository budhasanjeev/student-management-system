<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 9:31 PM
 */
session_start();
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<?php include 'layout/header.php'; ?>

<div class="container">
    <div class="row">
        <legend><a href="a_class.php">Class</a>/students</legend>
    </div>

    <?php
    $id = $_GET['id'];
    $class = getClassName($id, $connection);
    $student = getClassStudents($class, $connection);
    ?>

    <table class="table">
        <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>roll.no</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $student->fetch_assoc()){
            ?>


                <tr>

                    <td> <a href="a_profile.php?sid=<?php echo $row['id']; ?>&lid=<?php echo $id; ?>" ><img class="img-thumbnail" width="60px" src="../img/<?php echo $row["photo"] ?>"></a></td>
                    <td style="vertical-align: middle"><?php echo $row["first_name"]." ". $row["last_name"]; ?></td>
                    <td style="vertical-align: middle"><?php echo $row["address"] ?></td>
                    <td style="vertical-align: middle"><?php echo $row["contact_number"] ?></td>
                    <td style="vertical-align: middle"><?php echo $row["roll_number"]; ?></td>
                </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>