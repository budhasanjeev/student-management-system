<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 10/20/2016
 * Time: 7:55 PM
 */
//include '../config/databaseConnection.php';

session_start();
if($_SESSION['role'] != "Receptionist"){

?>
    <!DOCTYPE html>
    <html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Student Management</title>
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
<!--        <script type="text/javascript"  src="../js/jquery-1.12.4.min.js"></script>-->
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
                <img width="100%" height="250px" src="../img/<?php echo $row["photo"] ?>">
            <h1><?php echo $row['name']; ?></h1>
                <h4>Joined: <?php echo $row['start_date']; ?></h4>
                <table class="table table-responsive">
                    <tr>
                        <td>Experience:</td>
                        <td><?php echo $row['experience']; ?></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><?php echo $row['address']; ?></td>
                    </tr>
                    <tr>
                        <td>Contact:</td>
                        <td><?php echo $row['contact']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $row['email']; ?></td>
                    </tr>
                </table>
            <?php
            }
            ?>
        </div>
        <?php
        if($_SESSION['role'] == "Admin"){
            ?>
        <div class="col-md-5" style="background-color: antiquewhite;">
        <?php
        }else{
            ?>
            <div class="col-md-5" style="background-color: antiquewhite;">
            <?php
        }
        ?>
            <legend>Teaching</legend>

            <?php
                $teachingClass = getTeacherSubject($teacherID, $connection);
            ?>
            <table class="table table-responsive">
                <thead>
                <th>Class</th>
                <th>Subject</th>
                </thead>
                <?php
                while($row = $teachingClass->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo getClassName($row['class_id'], $connection); ?></td>
                        <td><?php echo getSubjectName($row['subject_id'], $connection); ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>

        </div>
            <?php
            if($_SESSION['role'] == "Admin" || $_SESSION['role'] == "sAdmin") {
                ?>
                <div class="col-md-4">
                    <legend>Add Class and Subjects</legend>
                    <form action="../controller/addClassSubject.php?id=<?php echo $teacherID; ?>" method="post">
                        <div class="form-group">
                            <label>Class:</label>
                            <select class="form-control" name="class" id="classID" onchange="getClassValue();">
                                <?php
                                while ($r = $class->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['class']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>subject</label>
                            <select class="form-control" name="subject" id="subjectClass">

                            </select>
                        </div>
                        <input type="submit" class="btn btn-block btn-primary" value="ADD"/>
                    </form>
                </div>
            <?php
            }
            ?>
    </div>

<script>
    function getClassValue(){
       var id = $("#classID").val();
//        console.log(id);
        data = {
            actionname:'getsubject',
            classid:id
        };
        var subject = $("#subjectClass");
        subject.empty();
        $.ajax({
            type:'POST',
            url:'http://localhost/student-management-system/common/service.php',
            data:data,
            success:function(data){
                final = JSON.parse(data);
                $.each(final,function(key,val){
                   subject.append("<option value='"+val.id+"'>"+val.subjectName+"</option>")
                });
            }
        });
    }
    $(function(){
        getClassValue();
    });
</script>

    </body>
</html>
<?php
}else{
    header('Location: logout.php');
}
?>