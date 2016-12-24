<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 10/20/2016
 * Time: 7:55 PM
 */
session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin' || $_SESSION['role'] == 'teacher' || $_SESSION['role'] == 'Receptionist'){
include '../config/databaseConnection.php';
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
    <legend>All teachers</legend>

    <?php
    $objCommon = new Common();
    $teacherList = $objCommon->getAllTeacher();
    ?>
    <table class="table table-responsive table-striped table-bordered display" id="teacher-table" cellspacing="0"
           width="100%">
        <thead>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Degree</th>
        <?php
        if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
            ?>
            <th>Actions</th>
        <?php
        }
        ?>

        </thead>
        <tbody>

        <?php
            foreach ($teacherList as $teacher) {
                ?>
                <tr>
                    <td><a href="editTeacher.php?id=<?php echo $teacher['id']; ?>"><img class="img-circle" width="60px" src="../img/<?php echo $teacher["photo"] ?>"></a></td>
                    <td><a href="editTeacher.php?id=<?php echo $teacher['id']; ?>"><?php echo $teacher['name'] ?></a></td>
                    <td><a href="editTeacher.php?id=<?php echo $teacher['id']; ?>"><?php echo $teacher['email'] ?></a></td>
                    <td><a href="editTeacher.php?id=<?php echo $teacher['id']; ?>"><?php echo $teacher['contact'] ?></a></td>
                    <td><a href="editTeacher.php?id=<?php echo $teacher['id']; ?>"><?php echo $teacher['address'] ?></a></td>
                    <td><a href="editTeacher.php?id=<?php echo $teacher['id']; ?>"><?php echo $teacher['degree'] ?></a></td>
                    <?php
                    if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
                    ?>
                        <td><button class="btn btn-primary" onclick="editTeacher(<?php echo $teacher['id'] ?>);">Edit</button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteTeacher(<?php echo $teacher['id'] ?>);">Delete</button></td>
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

    <div id="edit-teacher" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Teacher</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="../controller/teacherController.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="mode" value="update">
                        <input type="hidden" name="teacher_id" id="teacher_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class">Name: </label>
                                <input class="form-control" type="text" name="name" required="" id="name"/>
                            </div>

                            <div class="form-group">
                                <label for="class">Contact: </label>
                                <input class="form-control" placeholder="98********, 98********" type="text" name="contact" required="" id="contact"/>
                            </div>

                            <div class="form-group">
                                <label for="class">Email: </label>
                                <input class="form-control" type="email" name="email" id="email"/>
                            </div>

                            <div class="form-group">
                                <label for="class">Experience: </label>
                                <input class="form-control" type="text" name="experience" required="" id="experience"/>
                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="class">Username: </label>
                                <input class="form-control" type="text" name="username" required="" id="username"/>
                            </div>

                            <div class="form-group">
                                <label for="class">Address: </label>
                                <input class="form-control" type="text" name="address" required="" id="address"/>
                            </div>


                            <div class="form-group">
                                <label for="class">Degree: </label>
                                <input class="form-control" type="text" name="degree" required="" id="degree"/>
                            </div>

                            <div class="form-group">
                                <label for="class">Joined on: </label>
                                <input class="form-control" type="date" name="join_on" required="" id="join_on"/>
                            </div>

                            <div class="form-group">
                                <label for="class">Photo: </label>
                                <input type="file" name="photo" required=""/>
                            </div>

                        </div>

                        <div style="text-align: right">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

<script>
    function editTeacher(id) {

        $.ajax({
            type:"POST",
            cache:false,
            url:"../controller/teacherController.php",
            data:{mode:"edit",id:id},
            success:function(data){
                var data = JSON.parse(data);

                $('#name').val(data.name);
                $('#contact').val(data.contact);
                $('#email').val(data.email);
                $('#experience').val(data.experience);
                $('#username').val(data.username);
                $('#address').val(data.address);
                $('#degree').val(data.degree);
                $('#join_on').val(data.start_date);
                $('#teacher_id').val(data.id);

                $('#edit-teacher').modal('show');
            },
            error:function(error){

            }
        });
    }

    function deleteTeacher(id) {

        if(confirm('Are you sure you want to delete this teacher?'))
        {
            $.ajax({
                type:"POST",
                cache:false,
                url:"../controller/teacherController.php",
                data:{mode:"delete",id:id},
                success:function(data){

                    var data = JSON.parse(data);
                    
                    if(data.message){
                        alert("Successfully Deleted");
                        
                    }else {
                        alert("Failed to Delete");
                    }
                    
                    location.reload(true);
                },
                error:function(error){

                }
            });

        }

    }

    $('#teacher-table').dataTable();
</script>
</body>
</html>

<?php
}else{
    header('Location: logout.php');
}
?>
