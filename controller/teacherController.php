<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 11/13/2016
 * Time: 4:55 PM
 */

session_start();
include '../common/Common.php';

$objCommon = new Common();

if(isset($_POST['mode'])){

    if($_POST['mode']=='add'){

        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address  = $_POST['address'];
        $experience  = $_POST['experience'];
        $username    = $_POST['username'];
        $email = $_POST['email'];
        $degree = $_POST['degree'];
        $join_on = $_POST['join_on'];

        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];

        move_uploaded_file($photo_tmp,"../img/$photo");

        $result = array();

        $result = $objCommon->createTeacher($name,$contact,$address,$experience,$username,$address,$degree,$join_on,$photo,$email);

        if($result){
            $_SESSION['create_student'] = 'success';
        }
        else{
            $_SESSION['create_student'] = 'error';
        }

        header('Location:../views/a_teacher.php');


    } else if($_POST['mode']=='edit'){

        $std_id = $_POST['id'];

        $result = array();

        $result = $objCommon->editTeacher($std_id);

        echo json_encode($result);
        
    } else if($_POST['mode']=='delete'){

        $teacher_id = $_POST['id'];

        $result = array();

        $result = $objCommon->deleteTeacher($teacher_id);

        echo json_encode($result);

    }
    else if($_POST['mode']=='update'){

        $_SESSION['student'] = null;

        $id     = $_POST['teacher_id'];
        $name  = $_POST['name'];
        $contact = $_POST['contact'];
        $email    = $_POST['email'];
        $experience = $_POST['experience'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $degree   = $_POST['degree'];
        $join_on = $_POST['join_on'];
        
        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];

        move_uploaded_file($photo_tmp,"../img/$photo");

        $result = array();

        $result = $objCommon->updateTeacher($id,$name,$contact,$email,$experience,$username,$address,$degree,$join_on,$photo);

        if($result){
            $_SESSION['create_student'] = 'success';
        }
        else{
            $_SESSION['create_student'] = 'error';
        }

        header('Location:../views/a_teacher.php');

    }

}