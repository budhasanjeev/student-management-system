
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

    $email = $_POST['email'];
    $password = $_POST['password'];
    $stored_password = "null";
    $role = "null";
    
    $select_from_user = "SELECT id, password, role FROM user WHERE email = '$email'";

    $select_from_teacher = "SELECT id, password FROM teacher WHERE email = '$email'";

    $result_from_user = $connection->query($select_from_user);

    $result_from_teacher = $connection->query($select_from_teacher);

    if(mysqli_num_rows($result_from_user) > 0) {
        $row = $result_from_user->fetch_assoc();
        $stored_password = $row['password'];
        $role = $row['role'];
        $user_id = $row['id'];

    }else if(mysqli_num_rows($result_from_teacher) > 0){

        $row = $result_from_teacher->fetch_assoc();
        $stored_password = $row['password'];
        $role = 'teacher';
        $teacher_id = $row['id'];
    }

    if(md5($password) == $stored_password){

        if($role == "Admin" || $role == "sAdmin"){
            echo "admin";
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
            header("Location: admin.php");
        }
        else if($role == "Parents"){
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
            header("Location: ../controller/c_checkChildren.php");
        }
        else if($role == "Receptionist"){
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
            header("Location: teacher.php");
        }
        else if($role == "teacher") {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['teacher_id'] = $teacher_id;
            echo $_SESSION['role'];
            header("Location: a_class.php");

        }
    }else{
        echo "<h5 style='text-align: center; background-color: red; color: #ffffff;'>user not found</h5>";
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
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Ultra" rel="stylesheet">
</head>
<body style="font-family: 'Kaushan Script', cursive;">
<div style="height: 100%; width: 100%; display: flex; justify-content: center; align-items: center; position: absolute;">
<div style="text-align: center;">
    <div class="container" style="text-align: center;">

    </div>

    <div style="width: 50%; display: inline-block;">
        <div class="highlight login-div">
            <h3 style="font-family: 'Ultra', serif;">Student Management Portal</h3>

            <hr/><br/>
            <form class="form-horizontal"  method="post" action="">
                <!--        <legend><h2>System Login</h2></legend>-->
                <div class="form-group">
                    <label class="glyphicon glyphicon-user col-md-2 login-glyphicon"></label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" required="" placeholder="email address"/>
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