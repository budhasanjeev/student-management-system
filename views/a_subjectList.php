<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/20/2016
 * Time: 8:53 PM
 */

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
                ?>
                <tr>
                    <td><?php echo $row["subject_name"]; ?></td>
                    <td><?php echo getSubjectTeacher($row['id'], $connection); ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

    </body>
</html>