<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 9:31 PM
 */
session_start();
if($_SESSION['role'] != 'parents'){

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

    <?php
    $id = $_GET['id'];
    $class = getClassName($id, $connection);
    $student = getClassStudents($class, $connection);
    ?>

    <table class="table" id="student-table">
        <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Section</th>
            <th>Address</th>
            <th>Contact Number</th>
            <th>roll.no</th>
            <?php
            if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
                ?>
                <th>Action</th>
                <?php
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $student->fetch_assoc()){
            ?>


                <tr>

                    <td> <a href="a_profile.php?sid=<?php echo $row['id']; ?>&lid=<?php echo $id; ?>" ><img class="img-thumbnail" width="60px" src="../img/<?php echo $row["photo"] ?>"></a></td>
                    <td style="vertical-align: middle"><?php echo $row["first_name"]." ". $row["last_name"]; ?></td>

                    <td style="vertical-align: middle"><?php echo $row["section"] ?></td>
                    <td style="vertical-align: middle"><?php echo $row["address"] ?></td>
                    <td style="vertical-align: middle"><?php echo $row["contact_number"] ?></td>
                    <td style="vertical-align: middle"><?php echo $row["roll_number"]; ?></td>
                    <?php
                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
                        ?>
                        <td style="vertical-align: middle">
                            <form action="../controller/studentController.php" method="post">
                                <input type="hidden" name="mode" value="edit">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <button class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></button>
                            </form>
                            <button class="btn btn-default" onclick="deleteStudent(<?php echo $row['id'] ?>)"><span class="glyphicon glyphicon-trash"></span></button>
                        </td>
                        <?php
                    }
                    ?>
                </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    $('#student-table').dataTable();
</script>

</body>
</html>

<?php
}else{
    header('Location: logout.php');
}
?>