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
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

    </body>
</html>