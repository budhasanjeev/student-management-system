<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 9/13/2016
 * Time: 3:11 PM
 */
include  '../common/Common.php';
include  '../config/databaseConnection.php';

$objCommon = new Common();

session_start();

if(isset($_POST['mode'])){

    if(isset($_POST['mode']) == 'add'){

        $username = $_POST['username'];
        $role     = $_POST['role'];
        $emailAddress  = $_POST['email'];
        $student_id  = $_POST['student_id'];

        $image = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/$image");
        
        $result = $objCommon->createUser($username,$role,$emailAddress,$student_id,$image,$connection);
        
        if($result){
            $_SESSION['create_user'] = 'success';
        }
        else{
            $_SESSION['create_user'] = 'error';
        }

        header('Location:../views/admin/user.php');
    }

    else if(isset($_POST['mode']) == 'edit'){

    }

    else if(isset($_POST['mode']) == 'update'){

    }

    else if(isset($_POST['mode']) == 'delete'){

        $id = $_POST['id'];

        $result = array();

        $result = $objCommon->deleteUser($id,$connection);

        return 'dada';
    }
}