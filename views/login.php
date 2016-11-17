
<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 11:55 AM
 */


include '../config/databaseConnection.php';
session_start();

if (isset($_POST["login"])){

    echo "Login";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stored_password = "null";
    $role = "null";

    $select_from_user = "SELECT password, role FROM user WHERE email = '$email'";

    $select_from_teacher = "SELECT password FROM teacher WHERE email = '$email'";

    $result_from_user = $connection->query($select_from_user);

    $result_from_teacher = $connection->query($select_from_teacher);

    if(mysqli_num_rows($result_from_user) > 0) {
        $row = $result_from_user->fetch_assoc();
        $stored_password = $row['password'];
        $role = $row['role'];

    }else if(mysqli_num_rows($result_from_teacher) > 0){

        $row = $result_from_teacher->fetch_assoc();
        $stored_password = $row['password'];
        $role = 'teacher';
    }

    if(md5($password) == $stored_password){

        if($role == "Admin"){
            echo "Admin";
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            header("Location: admin.php");

        }
        else if($role == "Parents"){
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            echo "parents";
            header("Location: admin.php");
        }
        else if($role == "teacher") {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            header("Location: teacher.php?id=1");

        }
    }else{
        echo "user not found";
    }
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<div style="height: 100%; width: 100%; display: flex; justify-content: center; align-items: center; position: absolute;">
<div style="text-align: center">
    <div class="container" style="text-align: center;">
        <h3>Student Management Portal</h3>
    </div>

    <div class="col-lg-6">
        <div class="highlight login-div">
            <form class="form-horizontal"  method="post" action="">
                <!--        <legend><h2>System Login</h2></legend>-->
                <div class="form-group">
                    <label class="glyphicon glyphicon-envelope col-md-2 login-glyphicon"></label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" required="" placeholder="username"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="glyphicon glyphicon-pencil col-md-2 login-glyphicon" for=""></label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" required="" placeholder="password"/>
                    </div>
                </div>

                <input class="btn btn-primary btn-block" name="login" type="submit" value="login"/>
            </form>
        </div>
    </div>
</div>
</div>

</body>
</html>