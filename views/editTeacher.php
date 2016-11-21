<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 10/20/2016
 * Time: 7:55 PM
 */
//include '../config/databaseConnection.php';
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
<?php include 'layout/header.php';

$teacherID = $_GET['id'];
$teacher = getTeacherInfo($teacherID, $connection);
$class = getClass($connection);
?>
    <div class="container">
        <div class="col-md-3">
            <?php
            while($row = $teacher->fetch_assoc()){
                ?>
                <h4>Joined: <?php echo $row['start_date']; ?></h4>
                <img class="img-circle" width="100%" height="250px" src="../img/<?php echo $row["photo"] ?>">
            <h1><?php echo $row['name']; ?></h1>
            <?php
            }
            ?>
        </div>
        <div class="col-md-5">
            <legend>Teaching</legend>

        </div>
        <div class="col-md-4">
            <legend>Add Class and Subjects</legend>
            <form action="">
                <div class="form-group">
                    <lable>Class:</lable>
                    <select class="form-control" name="class" id="classID" onchange="getClassValue()">
                        <?php
                        while($r = $class->fetch_assoc()){
                            ?>
                            <option value="<?php echo $r['id']; ?>"><?php echo $r['class']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <lable>subject</lable>
                </div>
            </form>
        </div>
    </div>

<script>
    function getClassValue(){
       var id = document.getElementById("classID").value;
        alert(id);
    }
</script>
    </body>
</html>