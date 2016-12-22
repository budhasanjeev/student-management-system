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
    </head>
    <body>
<?php include 'layout/header.php';
$classID = $_GET['id'];
$subject =  getClassSubject($classID, $connection);
?>

    <div class="container">
        <legend>Subjects of Class <?php echo getClassName($classID, $connection); ?></legend>
        <table class="table table-responsive table-stripped">
            <thead>
            <th>Subject</th>
            <th>Teacher</th>
            <?php
            if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
                ?>
                <th colspan="">Change/Assign Teacher</th>
            <?php
            }
            ?>
            </thead>
            <?php
            while($row = $subject->fetch_assoc()){
                $id = $row['id'];
                ?>
                <tr>
                    <td><?php echo $row["subject_name"]; ?></td>
                    <td><?php
                        if(getSubjectTeacher($id, $connection) != null){
                            echo getSubjectTeacher($id, $connection);
                        }else{
                            echo 'Not Assigned';
                        }
                        ?></td>
                    <?php
                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                        ?>

                        <td>
                            <form action="../controller/changeTeacher.php" method="post">
                                <input type="hidden" name="subject_id" value="<?php echo $id; ?>"/>
                                <input type="hidden" name="class_id" value="<?php echo $classID; ?>"/>
                                <select name="teacher_id" class="form-control" style="width: 50%; display: inline;">
                                    <?php
                                    $teachers = getTeacher($connection);
                                    while($row = $teachers->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" class="btn btn-primary" value="Change"/>
                            </form>
                        </td>
                        <td>
                            <a href="../controller/c_deleteSubject.php?id=<?php echo $id; ?>&class=<?php echo $classID; ?>">
                                <button class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"> </span> Delete
                                </button>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>


    </body>
</html>