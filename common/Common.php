<?php

/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:08 PM
 */
include '../config/databaseConnection.php';
//include '/PHPExcel/Classes/PHPExcel/IOFactory.php';

class Common
{

    public function login($username,$pwd){

        global $connection;

        $pwd = md5($pwd);

        $login_query = "SELECT *FROM user WHERE email_address = '$username' and password='$pwd' ";

        $result = mysqli_query($connection,$login_query);

        $data = array();

        if(mysqli_num_rows($result)>0){

            $data['message']='success';

            while($row = mysqli_fetch_assoc($result)){
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['role'] = $row['role'];
            }

        }
        else{
            $data['message']='fail';
        }

        return $data;

    }

    public function createStudentList($file_name,$student_record_temp){

        global $connection;

        $data = array();

        try{
            $objPHPExcel = PHPExcel_IOFactory::load("../excel_files/$file_name");
        }catch (Exception $e) {
            die('Error loading file "' . pathinfo($student_record_temp, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        $arrayCount = count($allDataInSheet);

        for($i = 2; $i <= $arrayCount; $i++){
            $student_id = trim($allDataInSheet[$i]['A']);
            $first_name = trim($allDataInSheet[$i]['B']);
            $last_name = trim($allDataInSheet[$i]['C']);
            $dob = trim($allDataInSheet[$i]['D']);
            $address = trim($allDataInSheet[$i]['E']);
            $contact_number = trim($allDataInSheet[$i]['F']);
            $father_name = trim($allDataInSheet[$i]['G']);
            $mother_name = trim($allDataInSheet[$i]['H']);
            $roll_number = trim($allDataInSheet[$i]['I']);
            $grade = trim($allDataInSheet[$i]['J']);
            $section = trim($allDataInSheet[$i]['K']);

            $duplicate_check_query = "select student_id from student where student_id = '$student_id'";

            $result = mysqli_query($connection,$duplicate_check_query);

            $row = mysqli_fetch_assoc($result);

            $std_id = $row['student_id'];

            if($std_id == ''){
                $created_date = date("Y-m-d");

                $insert_query = "insert into student(student_id,first_name,last_name,dob,address,contact_number,father_name,mother_name,roll_number,grade,section,created_date) values('$student_id','$first_name','$last_name','$dob','$address','$contact_number','$father_name','$mother_name','$roll_number','$grade','$section','$created_date')";

                if(mysqli_query($connection,$insert_query)>0){
                    $data['message'] = 'success';
                }
            }
            else{
                $data['message'] = 'fail';
            }
        }

        return $data;
    }

    public function getStudent(){
        global $connection;

        $select_student = "select *from student";

        $result = mysqli_query($connection,$select_student);

        $data = array();

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)){
            $data[$i]['id'] = $row['id'];
            $data[$i]['student_id'] = $row['student_id'];
            $data[$i]['first_name'] = $row['first_name'];
            $data[$i]['last_name'] = $row['last_name'];
            $data[$i]['dob'] = $row['dob'];
            $data[$i]['address'] = $row['address'];
            $data[$i]['contact_number'] = $row['contact_number'];
            $data[$i]['father_name'] = $row['father_name'];
            $data[$i]['mother_name'] = $row['mother_name'];
            $data[$i]['roll_number'] = $row['roll_number'];
            $data[$i]['grade'] = $row['grade'];
            $data[$i]['section'] = $row['section'];
            $data[$i]['photo'] = $row['photo'];
            $i++;
        }

        return $data;
    }

    public function createStudent($std_id,$fname,$lname,$dob,$address,$contact,$rollNumber,$grade,$section,$fatherName,$motherName,$photo){

        global $connection;

        $created_date = date('Y-m-d');

        $insert_student = "insert into student(student_id,first_name,last_name,dob,address,contact_number,father_name,mother_name,roll_number,grade,section,photo,created_date)
                            values('$std_id','$fname','$lname','$dob','$address','$contact','$fatherName','$motherName','$rollNumber','$grade','$section','$photo','$created_date')";

        $result = mysqli_query($connection,$insert_student);

        return $result;

    }

    public function editStudent($id){

        global $connection;

        $select_student = "select *from student where id = '$id' ";

        $data = array();

        $result = mysqli_query($connection,$select_student);

        while ($row = mysqli_fetch_assoc($result)){

            $data['id'] = $row['id'];
            $data['student_id'] = $row['student_id'];
            $data['first_name'] = $row['first_name'];
            $data['last_name'] = $row['last_name'];
            $data['dob'] = $row['dob'];
            $data['address'] = $row['address'];
            $data['contact_number'] = $row['contact_number'];
            $data['father_name'] = $row['father_name'];
            $data['mother_name'] = $row['mother_name'];
            $data['roll_number'] = $row['roll_number'];
            $data['grade'] = $row['grade'];
            $data['section'] = $row['section'];
            $data['photo'] = $row['photo'];
        }

        return $data;
    }

    public function updateStudent($std_id,$fname,$lname,$dob,$address,$contact,$rollNumber,$grade,$section,$fatherName,$motherName,$photo,$id){
        global $connection;

        $updated_date = date('Y-m-d');

        $update_student = "update student set 'student_id' = '$std_id','first_name' = '$fname','last_name'='$lname','dob' = '$dob','address'='$address','contact_number'='$contact','father_name'='$fatherName','mother_name'='$motherName','roll_number'='$rollNumber','grade'='$grade','section'='$section','photo'='$photo','updated_date'='$updated_date' where id = '$id' ";

        $result = mysqli_query($connection,$update_student);

        return $update_student;
    }

    public function deleteStudent($id){

        global $connection;

        $delete_student = "delete from student where id = '$id'";

        $result = mysqli_query($connection,$delete_student);

        $data = array();
        
        if($result){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }
        
        return $data;
    }

    public function createUser($firstName,$lastName,$username,$role,$emailAddress,$student_id,$image){

        global $connection;

        $created_date = date("Y-m-d");
        $password = md5('123');

        $create_user = "INSERT INTO user(first_name, last_name, username, password, role, email, student_id, photo, created_date) VALUES('$firstName','$lastName','$username','$password','$role','$emailAddress','$student_id','$image','$created_date')";

        $result = mysqli_query($connection,$create_user);
    
        return $result;    
    }


    public function editUser($id){

        global $connection;

        $select_query = "SELECT *FROM user WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['first_name'] = $row["first_name"];
            $data['last_name'] = $row["last_name"];
            $data['username'] = $row["username"];
            $data['role'] = $row["role"];
            $data['email'] = $row["email"];
            $data['photo'] = $row["photo"];
            $data['student_id'] = $row["student_id"];
        }

        return $data;
    }

    public function updateUser($firstName,$lastName,$username,$role,$emailAddress,$student_id,$image,$user_id){

        global $connection;

        $updated_date = date("Y-m-d");

        $create_user = "update user set first_name = '$firstName',last_name='$lastName',username='$username', role ='$role',email='$emailAddress',student_id='$student_id',photo='$image',updated_date='$updated_date' WHERE id = '$user_id'";

        $result = mysqli_query($connection,$create_user);
        
        return $result;
    }

    public function deleteUser($id){

        global $connection;

        $delete_user = "DELETE FROM user WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_user);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function getUser(){

        global $connection;

        $select_user = "SELECT *FROM user";

        $result = mysqli_query($connection,$select_user);

        $data = array();

        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['first_name'] = $row["first_name"];
            $data[$i]['last_name'] = $row["last_name"];
            $data[$i]['username'] = $row["username"];
            $data[$i]['role'] = $row["role"];
            $data[$i]['email'] = $row["email"];
            $data[$i]['photo'] = $row["photo"];
            $i++;
        }

        return $data;

    }


}